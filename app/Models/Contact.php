<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function companies(){
        return $this->belongsToMany(Company::class, 'employments')->using(Employment::class)->withPivot('startDate','endDate','wage');
    }

    public function primaryCompany(){
        return $this->belongsTo(Company::class, 'primaryCompany_id');
    }

    public function madeBy(){
        return $this->belongsTo(User::class, 'madeBy_id');
    }

    public function addresses(){
        return $this->morphMany(Address::class, 'addressable');
    }
}
