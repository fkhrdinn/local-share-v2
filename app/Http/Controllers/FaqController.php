<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use RealRashid\SweetAlert\Facades\Alert;

class FaqController extends Controller
{
    public function index()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        return view('admin.faq.faq', compact('data'));
    }

    public function destroy($id)
    {
        $data = Faq::find($id);
        $data->delete();
        toast('FAQ has been deleted successfully.','success')->autoClose(5000)->hideCloseButton();
        return redirect('/admin/faq');
    }

    public function edit($faq)
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        return view('admin.faq.form', compact('data', 'faq'));
    }

    public function create()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        $faq = null;
        return view('admin.faq.form', compact('data', 'faq'));
    }
}
