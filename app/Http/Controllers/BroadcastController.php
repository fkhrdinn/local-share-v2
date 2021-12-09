<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BroadcastController extends Controller
{
    public function index()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.broadcast.broadcasts', compact('data'));
    }

    public function destroy($id)
    {
        $data = Broadcast::find($id);
        $data->delete();
        toast('Broadcast has been deleted successfully.','success')->autoClose(5000)->hideCloseButton();
        return redirect('/admin/broadcasts');
    }

    public function create()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.broadcast.form', compact('data'));
    }
}
