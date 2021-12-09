<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.settings.settings', compact('data'));
    }
}
