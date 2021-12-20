@if($user->getMedia('logo')->count())
    <img src="{{ $user->getFirstMediaUrl('logo') }}" alt="" style="width:150px;height:100px" class="p-1 bg-white border rounded dark:border-black"> 
@endif