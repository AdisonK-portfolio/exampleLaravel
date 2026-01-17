<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $guarded = [];

    public function companies(){
        return $this->belongsToMany(Company::class, 'employments')->using(Employment::class)->withPivot('startDate','endDate','wage');
        //return $this->through('employments')->has('company');//->withPivot('startDate','endDate','wage');
        //return $this->hasManyThrough(Company::class, Employment::class);
    }

    public function primaryCompany(){
        return $this->belongsTo(Company::class, 'primaryCompany_id');
    }

    public function madeBy(){
        return $this->belongsTo(User::class, 'madeBy_id');
    }
}
