<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'studname', 'dob', 'class', 'gender', 'status', 'district', 'state', 'donor',
    ];
}
