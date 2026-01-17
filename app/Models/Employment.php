<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employment extends Pivot
{
    /** @use HasFactory<\Database\Factories\EmploymentFactory> */
    use HasFactory;

    protected $table = "employments";

    // public function contact(){
    //     return $this->belongsTo(Contact::class);
    // }

    // public function company(){
    //     return $this->belongsTo(Company::class);
    // }
}
