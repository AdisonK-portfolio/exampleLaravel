<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromQuery, WithHeadings, WithMapping, WithEvents
{
    use Exportable;

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
        
        $contacts = Contact::query()->with('company');

        if(request('search')){
            // Not validating search input, because Laravel's query builder sanitizes it already (protects against SQL injection)
            $search = request('search');

            $contacts->where('firstName', $search)
                        ->orWhere('lastName', $search)
                        ->orWhere('email', $search)
                        ->orWhereRelation('company', 'name','=', $search);
        }

        return $contacts;
    }

    public function headings(): array {

        return [
            'First Name',
            'Last Name',
            'Email',
            'Company'
        ];
    }

    public function map($contact): array {

        return [
            $contact->firstName,
            $contact->lastName,
            $contact->email,
            $contact->company->name
        ];
    }
}
