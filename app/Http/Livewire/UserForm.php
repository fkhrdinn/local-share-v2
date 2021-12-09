<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class UserForm extends Component
{
    use WithFileUploads;
    
    public $user;
    public $merchantName;
    public $email;
    public $mobileNumber;
    public $logoData; //logo data
    public $logo; //temp
    public $logos; //existing image from database

    public function rules()
    {
        $rules = [
            'merchantName' => 'required|string|max:255',
            'email' => 'unique:users|required|',
            'mobileNumber' => 'required',
            'logo' => 'nullable|image|max:10024'
        ];

        return $rules;
    }

    public function mount($user = null)
    {
        $this->user = $user ?? [];
        if(!is_null($user))
        {
            $this->user = User::find($user);
            $this->merchantName = $this->user->name;
            $this->email = $this->user->email;
            $this->mobileNumber = $this->user->mobile_number;
            $this->logos = $this->user->getFirstMediaUrl('logo');
            $this->logoData = $this->user->getFirstMedia('logo');
        }
    }

    public function update()
    {
        /* $this->validate(); */
        $user = Auth::user();
        
        User::where('id', $this->user->id)
        ->update([
            'name' => $this->merchantName,
            'email' => $this->email,
            'mobile_number' => $this->mobileNumber,
        ]);

        if($this->logo)
        { 
            $user
                ->addMedia($this->logo->getRealPath())
                ->usingName($this->logo->getClientOriginalName())
                ->toMediaCollection('logo');

            $this->logo = '';

            if($this->logoData)
            {
                $logoToDelete = [$this->logoData->id];
                $media = collect($user->getMedia('logo')->toArray())
                    ->filter(
                        function ($media) use ($logoToDelete) {
                            return !in_array($media['id'], $logoToDelete);
                        }
                    )->all();
                
                $user->updateMedia($media,'logo');
            }
        }

        toast('User has been updated successfully.','success')->autoClose(5000)->hideCloseButton();

        return redirect()->to('/admin/merchants');
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
