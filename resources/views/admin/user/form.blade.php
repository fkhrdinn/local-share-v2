@extends('layouts.app')

@section('content')
<div class="bg-white text-gray-600 shadow-inner dark:bg-gray-900 mx-auto py-5 px-4 sm:px-6 lg:px-8">
    Product / <p class="inline text-gray-400 text-sm"> Update </p>
</div>

<div>
    <div class="py-12">
        <div class="md:px-6 sm:px-4 lg:px-8">     
            <livewire:user-form :user="$user"/>       
        </div>
    </div>
</div>
@endsection