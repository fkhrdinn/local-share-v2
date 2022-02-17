@extends('layouts.app')

@section('content')
<div class="bg-white text-gray-400 shadow-inner dark:bg-gray-900 mx-auto py-5 px-4 sm:px-6 lg:px-8">
    Dashboard
</div>

<div>
    <div class="py-12">
        <div class="md:px-6 sm:px-4 lg:px-8">
            <div>
                <livewire:summary/>
            </div>
        </div>
    </div>
</div>
@endsection