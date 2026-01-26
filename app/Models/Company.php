<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function contacts() {
        return $this->belongsToMany(Contact::class, 'employments')->using(Employment::class)->withPivot('startDate','endDate','wage');
    }

    public function addresses(){
        return $this->morphMany(Address::class, 'addressable');
    }
}
