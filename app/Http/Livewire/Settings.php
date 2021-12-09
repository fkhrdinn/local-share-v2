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
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    public $darkMode;

    public function mount()
    {
        $this->darkMode = Preference::where('user_id', Auth::user()->id)
            ->where('key', 'dark_mode')
            ->value('value'); 
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