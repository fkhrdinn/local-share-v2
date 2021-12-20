<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Preference;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

        return view('admin.category.category', compact('data'));
    }
    
    public function create()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();

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
