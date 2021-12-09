<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'quantity',
        'value',
        'type',
        'expires_at',
        'effective_at',
        'min_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }    
}
