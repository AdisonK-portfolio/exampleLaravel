<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employment extends Pivot
{
    /** @use HasFactory<\Database\Factories\EmploymentFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = "employments";

    // public function contact(){
    //     return $this->belongsTo(Contact::class);
    // }

    // public function company(){
    //     return $this->belongsTo(Company::class);
    // }
}
