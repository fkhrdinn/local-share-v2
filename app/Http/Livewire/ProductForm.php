<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class ProductForm extends Component
{
    use WithFileUploads;
    
    public $product;
    
    public $productName;
    public $productDescription;
    public $price;
    public $stock;
    public $coverData; //cover photo data
    public $coverPhoto; //temp
    public $coverPhotos; //existing from database
    public $productImage; //temp
    public $productImages; //existing from database
    public $categories;
    public $category;
    public $deletedImages = [];

    public function rules()
    {
        $rules = [
            'productName' => 'required|string|max:255',
            'price' => 'required',
            'stock' => 'integer|required',
            'coverPhoto' => 'required|image|max:10024',
            'productImage.*' => 'image|max:10024',
            'category' => 'required|integer'
        ];
        return $rules;
    }

    public function mount($product = null)
    {
        $this->product = $product ?? [];
        if(!is_null($product))
        {
            $this->product = Product::find($product);
            $this->productName = $this->product->name;
            $this->productDescription = $this->product->description;
            $this->price = $this->product->price;
            $this->stock = $this->product->quantity;
            $this->coverPhotos = $this->product->getFirstMediaUrl('cover_photo');
            $this->coverData = $this->product->getFirstMedia('cover_photo');
            $this->productImages = $this->product->getMedia('images');
            $this->category = $this->product->category_id;
        }
    }

    public function create()
    {
        $this->validate();

        $model = Product::create([
            'name' => $this->productName,
            'description' => $this->productDescription,
            'merchant_id' => Auth::user()->id,
            'price' => $this->price,
            'quantity' => $this->stock,
            'category_id' => $this->category,
        ]);

        if($this->coverPhoto)
        {
            $model
                ->addMedia($this->coverPhoto->getRealPath())
                ->usingName($this->coverPhoto->getClientOriginalName())
                ->toMediaCollection('cover_photo');

            $this->coverPhoto = '';
        }

        if($this->productImage)
        {
            foreach($this->productImage as $image)
            {
                $model
                    ->addMedia($image->getRealPath())
                    ->usingName($image->getClientOriginalName())
                    ->toMediaCollection('images');
            }
            $this->productImage = '';
        }

        toast('Product has been created successfully.','success')->autoClose(5000)->hideCloseButton();

        return redirect()->to('/admin/product');
    }

    public function update()
    {
        $this->validate([
            'productName' => 'required|string|max:255',
            'price' => 'required',
            'stock' => 'integer|required',
            'coverPhoto' => 'nullable|image|max:10024',
            'productImage.*' => 'image|max:10024',
            'category' => 'required|integer'
        ]); 

        $model = $this->product;

        Product::where('id', $this->product->id)
        ->update([
            'name' => $this->productName,
            'description' => $this->productDescription,
            'merchant_id' => Auth::user()->id,
            'price' => $this->price,
            'quantity' => $this->stock,
            'category_id' => $this->category,
        ]);

        if($this->coverPhoto)
        {
            $model
                ->addMedia($this->coverPhoto->getRealPath())
                ->usingName($this->coverPhoto->getClientOriginalName())
                ->toMediaCollection('cover_photo');

            $this->coverPhoto = '';

            $coverToDelete = [$this->coverData->id];
            $media = collect($model->getMedia('cover_photo')->toArray())
                ->filter(
                    function ($media) use ($coverToDelete) {
                        return !in_array($media['id'], $coverToDelete);
                    }
                )->all();
            
            $model->updateMedia($media,'cover_photo');
        }

        if ($this->productImage) 
        {
            foreach ($this->productImage as $image) {
                $model
                    ->addMedia($image->getRealPath())
                    ->usingName($image->getClientOriginalName())
                    ->toMediaCollection('images');
            }
            $this->productImage = '';
        }

        if ($this->deletedImages) 
        {
            $keysToDelete = $this->deletedImages;
            $media = collect($model->getMedia('images')->toArray())
                ->filter(
                    function ($media) use ($keysToDelete) {
                        return ! in_array($media['id'], $keysToDelete);
                    }
                )->all();

            $model->updateMedia($media, 'images');
        }

        toast('Product has been updated successfully.','success')->autoClose(5000)->hideCloseButton();

        return redirect()->to('/admin/product');
    }

    public function render()
    {
        $this->categories = Category::get();
        return view('livewire.product-form');
    }
}
