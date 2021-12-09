@if($user->getMedia('logo')->count())
    <img src="{{ $user->getFirstMediaUrl('logo') }}" alt="" style="width:150px;height:100px"> 
@endif