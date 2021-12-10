<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Preference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class Settings extends Component
{
    public $user;
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    public $darkMode;
    public $userName;
    public $email;
    public $mobileNumber;
    public $logo; //temp
    public $logos; //existing image from database
    public $logoData; //logo data
    public $facebook;
    public $twitter;
    public $instagram;

    public function mount($user = null)
    {
        $this->user = $user ?? [];
        
        if(!is_null($user))
        {
            $this->user = User::find($user);
            $this->userName = $this->user->name;
            $this->email = $this->user->email;
            $this->mobileNumber = $this->user->mobile_number;
            $this->logos = $this->user->getFirstMediaUrl('logo');
            $this->logoData = $this->user->getFirstMedia('logo');
            $this->facebook = Preference::where('user_id', $this->user->id)
                ->where('key', 'facebook')
                ->value('value');
            $this->twitter = Preference::where('user_id', $this->user->id)
                ->where('key', 'twitter')
                ->value('value');
            $this->instagram = Preference::where('user_id', $this->user->id)
                ->where('key', 'instagram')
                ->value('value');
            $this->darkMode = Preference::where('user_id', $this->user->id)
                ->where('key', 'dark_mode')
                ->value('value');
        }
    }

    public function updateProfile()
    {
        $this->validate([
            'mobileNumber' => 'required|string|max:255',
            'logo' => 'image|max:10024|nullable',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
        ]);

        $user = $this->user;
        
        User::where('id', $user->id)
        ->update([
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

        //facebook url
        if(!Preference::where('user_id', $user->id)->where('key', 'facebook')->value('value') && $this->facebook)
        {
            Preference::create([
                'user_id' => $user->id,
                'key' => 'facebook',
                'value' => $this->facebook,
            ]);
        }
        else
        {
            Preference::where('user_id', $user->id)
            ->update([
                'value' => $this->facebook,
            ]);
        }

        //twitter url
        if(!Preference::where('user_id', $user->id)->where('key', 'twitter')->value('value') && $this->twitter)
        {
            Preference::create([
                'user_id' => $user->id,
                'key' => 'twitter',
                'value' => $this->twitter,
            ]);
        }
        else
        {
            Preference::where('user_id', $user->id)
            ->update([
                'value' => $this->twitter,
            ]);
        }

        //instagram url
        if(!Preference::where('user_id', $user->id)->where('key', 'instagram')->value('value') && $this->instagram)
        {
            Preference::create([
                'user_id' => $user->id,
                'key' => 'instagram',
                'value' => $this->instagram,
            ]);
        }
        else
        {
            Preference::where('user_id', $user->id)
            ->update([
                'value' => $this->instagram,
            ]);
        }

        toast('Profile has been updated successfully.','success')->autoClose(5000)->hideCloseButton();

        return redirect()->to('/admin/settings');
    }

    public function updatePassword()
    {
        $user = Auth::user();

        if((Hash::check($this->currentPassword, $user->password)))
        {
            if($this->newPassword == $this->confirmPassword)
            {
                User::where('id', $user->id)
                ->update(
                    [
                        'password' => Hash::make($this->newPassword)
                    ]
                    );

                toast('Your password has been updated successfully.','success')->autoClose(5000)->hideCloseButton();
            }else{
                toast('Your new password does not match with your confirm password. Please try again.','error')->autoClose(5000)->hideCloseButton();
            }
        }else{
            toast('Your password does not match with your account password. Please try again.','error')->autoClose(5000)->hideCloseButton();
        }

        return redirect()->to('/admin/settings');
    }

    public function updateTheme()
    {
        if(!Preference::where('user_id', Auth::user()->id)->where('key', 'dark_mode')->value('value') && $this->darkMode)
        {
            Preference::create([
                'user_id' => Auth::user()->id,
                'key' => 'dark_mode',
                'value' => 'dark',
            ]);
        }
        elseif(Preference::where('user_id', Auth::user()->id)->where('key', 'dark_mode')->value('value') && !$this->darkMode)
        {
            Preference::where('user_id', Auth::user()->id)
            ->where('key', 'dark_mode')
            ->first()
            ->delete();
        }

        return redirect('/admin/settings');
    }

    public function render()
    {
        return view('livewire.settings');
    }
}