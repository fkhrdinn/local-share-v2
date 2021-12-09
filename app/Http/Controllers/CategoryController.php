<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.category.category', compact('data'));
    }
    
    public function create()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
        ->where('key','dark_mode')
        ->value('value');

        return view('admin.category.form', compact('data'));
    }

    public function destroy($category)
    {
        $data = Category::find($category);
        $data->delete();
        toast('Category has been deleted successfully.','success')->autoClose(5000)->hideCloseButton();
        return redirect('/admin/category');
    }
}
