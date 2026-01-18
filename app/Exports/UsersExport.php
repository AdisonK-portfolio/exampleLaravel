<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class UsersExport extends MyExport
{
    public function registerEvents(): array{

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
        
        $users = User::query();//->with('contacts');

        if(request('search')){
            // Don't need to validate search input, because Laravel's query builder sanitizes it already (protects against SQL injection)
            $search = request('search');

            $users->where('name', $search)
                    ->orWhere('email', $search);
        }

        return $users;
    }

    public function headings(): array {

        return [
            'Name',
            'Email'
        ];
    }

    public function map($user): array {

        return [
            'name' => $user->name,
            'email' => $user->email,
        ];
    }

    /* To set the classes on columns if using a generic index page */
    public function extraClasses(){
        return collect([
            'name' => '',
            'email' => ''
        ]);
    }
}
