<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FaqController extends Controller
{
    public function index()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

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
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.faq.form', compact('data', 'faq'));
    }

    public function create()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        $faq = null;
        return view('admin.faq.form', compact('data', 'faq'));
    }
}
