<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CompaniesExport extends MyExport
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
            }
        ];
    }

    public function query() {
        
        $companies = Company::query()->with('contacts');

        if(request('search')){
            // Don't need to validate search input, because Laravel's query builder sanitizes it already (protects against SQL injection)
            $search = request('search');

            $companies->where('name', $search);
        }

        return $companies;
    }

    public function headings(): array {

        return [
            'Name',
            'Description'
        ];
    }

    public function map($company): array {

        return [
            $company->name,
            $company->description,
        ];
    }

    public function extraClasses()
    {
        return collect([
            'name' => 'bg-black'
        ]);
    }
}
