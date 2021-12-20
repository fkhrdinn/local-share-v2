<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;

class InvoiceController extends Controller
{
    public function index()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        return view('admin.invoices.invoices', compact('data'));
    }
}
