<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    public function contacts(){
        return $this->belongsToMany(Contact::class, 'employments')->using(Employment::class)->withPivot('startDate','endDate','wage');
        // return $this->belongsToMany(Role::class)->withPivot('active', 'created_by');
        //return $this->throughEmployments()->hasContacts();//->withPivot('startDate','endDate','wage');
    }

    // public function employments(){
    //     return $this->hasMany(Employment::class);//->withPivot('startDate','endDate','wage');
    // }
}
