<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Models\Preference;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

class BroadcastController extends Controller
{
    public function index()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

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
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        return view('admin.broadcast.form', compact('data'));
    }
}
