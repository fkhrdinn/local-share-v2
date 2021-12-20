<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'product_id',
        'product_name',
        'variant_id',
        'quantity',
        'price',
        'merchant_id',
        'revenue',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
