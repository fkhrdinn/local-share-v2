<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;

class ProductController extends Controller
{
    public function index()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();
        return view('admin.products.product', compact('data'));
    }

    public function create()
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();
        
        $product=null;
        return view('admin.products.form', compact('data','product'));
    }

    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        toast('Product has been deleted successfully.','success')->autoClose(5000)->hideCloseButton();
        return redirect('/admin/product');
    }

    public function edit($product)
    {
        $data =  new DashboardController;
        $data = $data->isDarkMode();
        
        return view('admin.products.form', compact('data','product'));
    }
}
