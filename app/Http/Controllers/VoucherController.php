<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function index()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.voucher.voucher', compact('data'));
    }

    public function create()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.voucher.form', compact('data'));
    }

    public function destroy($id)
    {
        $data = Voucher::find($id);
        $data->delete();
        toast('Voucher has been deleted successfully.','success')->autoClose(5000)->hideCloseButton();
        return redirect('/admin/voucher');
    }
}
