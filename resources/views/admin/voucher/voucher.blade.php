@extends('layouts.app')

@section('content')
<div class="bg-white text-gray-400 shadow-inner dark:bg-gray-900 mx-auto py-5 px-4 sm:px-6 lg:px-8">
    Voucher
</div>

<div>
    <div class="py-12">
        <div class="md:px-6 sm:px-4 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-800">
                    <livewire:voucher-table/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection