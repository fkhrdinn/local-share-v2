<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Repositories\DashboardRepository;

class Summary extends Component
{
    public $auth;

    public function mount()
    {
        $this->auth = Auth::user();
    }

    public function getDashboard()
    {
        return App::make(DashboardRepository::class);
    }

    public function getTotalProperty()
    {
        $query = $this->getDashboard()->getInvoiceQuery();

        //DatePicker

        return $query->first();
    }

    public function getTotalSalesDiscountProperty()
    {
        $total_sales = $this->total->total_sales ?? 0;
        $query = $this->getDashboard()->getInvoiceDiscountQuery();

        //DatePicker

        $total_discount = $query->first()->total_discount ?? 0;

        return $total_sales + $total_discount;
    }

    public function getTotalProductProperty()
    {
        return $this->getDashboard()->getTotalProduct();
    }

    public function getTotalMerchantProperty()
    {
        return $this->getDashboard()->getTotalMerchant();
    }

    public function render()
    {
        return view('livewire.summary');
    }
}
