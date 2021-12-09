@extends('layouts.app')

@section('content')
<div class="bg-white text-gray-400 shadow-inner dark:bg-gray-900 mx-auto py-5 px-4 sm:px-6 lg:px-8">
    Settings
</div>

<div>
    <div class="py-12 md:w-1/2 w-full">
        <div class="md:px-6 sm:px-4 lg:px-8">
            <livewire:settings/>
        </div>
    </div>
</div>
@endsection