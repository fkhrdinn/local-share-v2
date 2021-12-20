<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\Preference;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function index()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        return view('admin.voucher.voucher', compact('data'));
    }

    public function create()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        $voucher = null;
        return view('admin.voucher.form', compact('data', 'voucher'));
    }

    public function edit($voucher)
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        return view('admin.voucher.form', compact('data', 'voucher'));
    }

    public function destroy($id)
    {
        $data = Voucher::find($id);
        $data->delete();
        toast('Voucher has been deleted successfully.','success')->autoClose(5000)->hideCloseButton();
        return redirect('/admin/voucher');
    }
}
