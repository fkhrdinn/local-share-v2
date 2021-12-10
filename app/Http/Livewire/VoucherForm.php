<?php

namespace App\Http\Livewire;

use DateTime;
use App\Models\Voucher;
use Livewire\Component;

class VoucherForm extends Component
{
    public $voucher;
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

    public function mount($voucher = null)
    {
        $this->voucher = $voucher ?? [];
        if(!is_null($voucher))
        {
            $expire;
            $effective;
            
            $this->voucher = Voucher::find($voucher);
            $this->code = $this->voucher->code;
            $this->quantity = $this->voucher->quantity;
            $this->value = $this->voucher->value;
            $this->type = $this->voucher->type;
            $expire = new DateTime($this->voucher->expires_at);
            $this->expires_at = $expire->format('Y-m-d');
            $effective = new DateTime($this->voucher->effective_at);
            $this->effective_at = $effective->format('Y-m-d');
            $this->min_amount = $this->voucher->min_amount;
        }
    }

    public function update()
    {
        $this->validate([
            'quantity' => 'required|integer',
            'value' => 'required|numeric',
            'type' => 'required|string',
            'expires_at' => 'required|date',
            'min_amount' => 'nullable|numeric',
        ]);

        if(is_null($this->code))
        {
            $this->code = $this->generateCode();
        }

        Voucher::where('id', $this->voucher->id)
        ->update([
            'code' => strtoupper($this->code),
            'quantity' => $this->quantity,
            'value' => $this->value,
            'type' => $this->type,
            'effective_at' => $this->effective_at.' 00:00:00',
            'expires_at' => $this->expires_at.' 23:59:59',
            'min_amount' => $this->min_amount,
        ]);

        toast('Voucher has been updated successfully.','success')->autoClose(5000)->hideCloseButton();

        return redirect()->to('/admin/voucher');
    }

    public function create()
    {
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
