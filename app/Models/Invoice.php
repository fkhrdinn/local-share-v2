<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'paid_at',
        'bill_id',
        'customer_id',
        'amount',
        'redeem_at',
        'invoice_code',
        'shipping_fee',
        'tracking_number',
        'status_id',
        'voucher_id',
        'discount'
    ];

    public function redeem()
	{
	    $this->redeemed_at = Carbon::now();
	    $this->save();
	}

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
	}

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
