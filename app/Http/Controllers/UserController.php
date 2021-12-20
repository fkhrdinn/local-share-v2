<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userEdit()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        return view('admin.user.user', compact('data'));
    }

    public function roleEdit()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        return view('admin.user.role', compact('data'));
    }

    public function edit($user)
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();
        
        return view('admin.user.form', compact('data','user'));
    }
}
