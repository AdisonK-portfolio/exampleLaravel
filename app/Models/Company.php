<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function contacts() {
        return $this->belongsToMany(Contact::class, 'employments')->using(Employment::class)->withPivot('startDate','endDate','wage');
    }

}
