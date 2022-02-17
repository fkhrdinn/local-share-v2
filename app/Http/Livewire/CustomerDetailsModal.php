<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Customer;
use LivewireUI\Modal\ModalComponent;

class CustomerDetailsModal extends ModalComponent
{
    public $customer;
    public $invoice;

    public function mount(Customer $customer, Invoice $invoice)
    {
        $this->customer = $customer;
        $this->invoice = $invoice;
    }

    public function render()
    {
        return view('livewire.customer-details-modal');
    }
}
