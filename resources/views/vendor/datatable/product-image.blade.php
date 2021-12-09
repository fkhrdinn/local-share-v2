@if($product->getMedia('cover_photo')->count())
    <img src="{{ $product->getFirstMediaUrl('cover_photo') }}" alt="" style="width:150px;height:100px"> 
@endif