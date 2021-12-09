<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');

        return view('admin.products.product', compact('data'));
    }

    public function create()
    {
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');
        
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
        $data =  Preference::where('user_id', Auth::user()->id)
            ->where('key','dark_mode')
            ->value('value');
        
        return view('admin.products.form', compact('data','product'));
    }
}
