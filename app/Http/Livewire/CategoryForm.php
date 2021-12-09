<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    public $type;

    public function rules()
    {
        $rules = [
            'type' => 'required|string'
        ];
        return $rules;
    }

    public function create()
    {
        $this->validate();

        Category::create([
            'type' => $this->type
        ]);

        toast('Category has been created successfully.','success')->autoClose(5000)->hideCloseButton();

        return redirect()->to('/admin/category');
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
