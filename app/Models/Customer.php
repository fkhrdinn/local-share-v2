<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'mobile_phone', 
        'address', 
        'postcode', 
        'city', 
        'state'
    ];
}