<?php

namespace App\Http\Livewire;

use App\Models\Voucher;
use Livewire\Component;

class VoucherForm extends Component
{
    public $code;
    public $quantity;
    public $types = [
        null => 'Select Type',
        'free_shipping' => 'Free Shipping',
        'deduction' => 'Deduction',
        'percentage' => 'Percentage'
    ];
    public $type;
    public $value;
    public $min_amount;
    public $effective_at;
    public $expires_at;

    public function rules()
    {
        $rules = [
            'code' => 'nullable|string|max:255|unique:vouchers,code',
            'quantity' => 'required|integer',
            'value' => 'required|numeric',
            'type' => 'required|string',
            'expires_at' => 'required|date',
            'min_amount' => 'nullable|numeric',
        ];

        return $rules;
    }

    public function create()
    {
        $this->validate();

        if (is_null($this->code)) {
            $this->code = $this->generateCode();
        }

        Voucher::create(
            [
                'code' => strtoupper($this->code),
                'quantity' => $this->quantity,
                'value' => $this->value,
                'type' => $this->type,
                'effective_at' => $this->effective_at.' 00:00:00',
                'expires_at' => $this->expires_at.' 23:59:59',
                'min_amount' => $this->min_amount,
            ]
        );

        toast('Voucher has been created successfully.','success')->autoClose(5000)->hideCloseButton();

        return redirect()->to('/admin/voucher');
    }

    public function generateCode()
    {
        $characters = 'ABCDEFGHJKLMNOPQRSTUVWXYZ234567890';
        $length = strlen($characters);

        $codeLength = 6;
        $code = '';

        for ($i = 0; $i < $codeLength; $i++) {
            $code .= $characters[rand(0, $length-1)];
        }

        return $code;
    }

    public function render()
    {
        return view('livewire.voucher-form');
    }
}
