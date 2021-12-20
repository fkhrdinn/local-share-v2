<div class="flex">
    <div>
        @if($product->getMedia('cover_photo')->count())
            <img src="{{ $product->getFirstMediaUrl('cover_photo') }}" alt="" style="width:150px;height:100px" class="p-1 bg-white border rounded dark:border-black"> 
        @endif
    </div>
    <div class="block pl-4">
        <div class="text-sm">
            Product Name : <p class="font-bold inline">{{ $product->name }}</p>
        </div>
        <div class="text-sm">
            Unit Price : <p class="font-bold inline">{{ $product->price }}</p>
        </div>
        <div class="text-sm">
            Quantity : <p class="font-bold inline">{{ $invoice->quantity }}</p>
        </div>
    </div>
</div>