<?php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ContactsExport extends MyExport
{
    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()
                        ->getStyle('A1:D1')
                        ->applyFromArray([
                                'borders' => [
                                    'bottom' => [
                                        'borderStyle' => Border::BORDER_THIN,
                                        'color' => ['rgb' => '000000'],
                                    ],
                                ]
                            ]);

                // need something with an actual calculation- like sum of amounts, not just reiterating the number of records
                // $highestRow = $event->sheet->getHighestRow(); 
                // $event->sheet->setCellValue('A' . ($event->sheet->getHighestRow() + 1), 'Total Number of Contacts:');
                // $event->sheet->setCellValue('D' . ($event->sheet->getHighestRow() + 1), $highestRow);
            }
        ];
    }

    public function query() {
        
        $contacts = Contact::query();

        $contacts->leftJoin('companies AS primaryCompanies', 'primaryCompanies.id', '=', 'contacts.primaryCompany_id')
                    ->leftJoin('addresses', function($join){
                        $join->on("addresses.addressable_id", "=", "contacts.id")
                                ->where("addresses.addressable_type", "=", Contact::class);
                    })
                    ->select('contacts.*', 'primaryCompanies.name AS primaryCompanyName','addresses.address1', 'addresses.address2','addresses.city','addresses.state','addresses.zip',);

        if(request('search')){
            // Don't need to validate search input, because Laravel's query builder sanitizes it already (protects against SQL injection)
            $search = request('search');

            $contacts->where('firstName', 'LIKE', '%' . $search . '%')
                        ->orWhere('lastName', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhere('primaryCompanies.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('address1', 'LIKE', '%' . $search . '%')
                        ->orWhere('city', 'LIKE', '%' . $search . '%');
        }

        $contacts->orderBy(request('sort', 'id'), request('dir', 'desc'));

        return $contacts;
    }

    public function headings(): array {

        return [
            'ID',
            'First Name',
            'Last Name',
            'Email',
            'Primary Company',
            'Address1',
            'Address2',
            'City',
            'State',
            'Zip'
        ];
    }

    public function map($contact): array {

        return [
            $contact->id,
            $contact->firstName,
            $contact->lastName,
            $contact->email,
            $contact->primaryCompanyName,
            $contact->address1,
            $contact->address2,
            $contact->city,
            $contact->state,
            $contact->zip,
        ];
    }

    /* To set the classes on columns in some possible uses of a generic index page */
    public function extraClasses(){
        
        return collect([
            'firstName' => '',
            'lastName' => '',
            'email' => 'hidden sm:table-cell',
            'primaryCompany' => '',
            'address1' => '',
            'address2' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
        ]);
    }
}
