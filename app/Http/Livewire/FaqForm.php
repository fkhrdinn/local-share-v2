<?php

namespace App\Http\Livewire;

use App\Models\Faq;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class FaqForm extends Component
{
    public $title;
    public $description;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function create()
    {
        $this->validate();

        Faq::create([
            'title' => $this->title,
            'description' => $this->description
        ]);
        toast('Faq has been created successfully.','success')->autoClose(5000)->hideCloseButton();
        return redirect()->to('admin/faq');
    }

    public function render()
    {
        return view('livewire.faq-form');
    }
}
