<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preference extends Model
{
    protected $fillable = [
        'user_id',
        'key',
        'value',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
