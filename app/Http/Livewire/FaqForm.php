<?php

namespace App\Http\Livewire;

use App\Models\Faq;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class FaqForm extends Component
{
    public $faq;
    public $title;
    public $description;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function mount($faq = null)
    {
        $this->faq = $faq ?? [];
        if(!is_null($faq))
        {
            $this->faq = Faq::find($faq);
            $this->title = $this->faq->title;
            $this->description = $this->faq->description;
        }
    }

    public function update()
    {
        $this->validate();

        Faq::where('id', $this->faq->id)
        ->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        
        toast('Faq has been updated successfully.','success')->autoClose(5000)->hideCloseButton();
        return redirect()->to('admin/faq');
    }

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
