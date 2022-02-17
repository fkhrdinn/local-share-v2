<?php

namespace App\Repositories;

use DB;
use Auth;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;

class DashboardRepository
{
    public function mainQuery()
    {
        $query = Invoice::query()
            ->whereNotNull('invoices.paid_at')
            ->where('invoices.status_id', '!=', 5);

        return $query;
    }

    public function baseQuery()
    {
        $query = $this->mainQuery()
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->join('products', 'products.id', '=', 'invoice_items.product_id');
        
        if (Auth::user()->hasRole('Merchant')) {
            $query->where('products.merchant_id', Auth::user()->id);
        }

        return $query;
    }

    /* public function baseProductQuery() */

    public function getInvoiceQuery()
    {
        return $this->baseQuery()
            ->select(
                DB::raw('IFNULL(SUM((invoice_items.price * invoice_items.quantity)), 0) as total_sales'),
                DB::raw('IFNULL(COUNT(DISTINCT invoices.id), 0) as total_order')
            );
    }

    public function getTotalProduct()
    {
        $query = Product::query();

        if(Auth::user()->hasRole('Merchant')){
            $query
                ->where('products.merchant_id', Auth::user()->id);
        }

        return $query
            ->count();
    }

    public function getTotalMerchant()
    {
        $query = User::whereHas('roles', function ($query) {
            $query->whereIn('roles.name', ['Merchant']);
        });
        
        return $query
            ->count();
    }

    public function getInvoiceDiscountQuery()
    {
        return $this->mainQuery()
            ->select(
                DB::raw('IFNULL(SUM(invoices.discount), 0) as total_discount')
            );
    }
}