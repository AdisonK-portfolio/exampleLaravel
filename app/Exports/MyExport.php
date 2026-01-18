<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MyExport implements FromQuery, WithHeadings, WithMapping, WithEvents
{
    use Exportable;

    public function registerEvents(): array {
        return [];
    }

    public function query() {
        
        return;
    }

    public function headings(): array {
        return [];
    }

    public function map($user): array {
        return [];
    }

    public function extraClasses(){
        return collect();
    }
}
