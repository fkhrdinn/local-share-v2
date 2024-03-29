<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = $this->isDarkMode();
        return view('admin.dashboard.dashboard', compact('data'));
    }

    public function isDarkMode()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
        ->where('key','dark_mode')
        ->value('value');
        
        return $data;
    }
}
