<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ContactsExport extends MyExport
{
    public function registerEvents(): array
    {
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
        
        $contacts = Contact::query()->with('companies');

        if(request('search')){
            // Don't need to validate search input, because Laravel's query builder sanitizes it already (protects against SQL injection)
            $search = request('search');

            $contacts->where('firstName', $search)
                        ->orWhere('lastName', $search)
                        ->orWhere('email', $search)
                        ->orWhereRelation('companies', 'name','=', $search);
        }

        if(request('sort')){
            
        }

        return $contacts->where('id', '<', '100');
    }

    public function headings(): array {

        return [
            'First Name',
            'Last Name',
            'Email',
            'Companies'
        ];
    }

    public function map($contact): array {

        return [
            'firstName' => $contact->firstName,
            'lastName' => $contact->lastName,
            'email' => $contact->email,
            'companies' => $contact->companies->pluck('name')->implode(', ')
        ];
    }

    public function extraClasses(){ //$key
        return collect([
            'firstName' => '',
            'lastName' => '',
            'email' => 'bg-black',
            'companies' => ''
        ]); //->get($key);
    }
}
