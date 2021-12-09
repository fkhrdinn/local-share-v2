<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userEdit()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.user.user', compact('data'));
    }

    public function roleEdit()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.user.role', compact('data'));
    }

    public function edit($user)
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');
        
        return view('admin.user.form', compact('data','user'));
    }
}
