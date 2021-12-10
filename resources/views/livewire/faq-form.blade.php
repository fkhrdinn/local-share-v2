@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">       
@endsection

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" >
    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
        <p class="font-bold text-lg">Create FAQ</p>
        <hr>

        <div class="mt-4">
            <div class="flex mb-4">
                <div class="w-1/4">
                    <label> 
                    Title <i class="text-red-400">*</i>
                    </label>
                </div>

                <div class="w-3/4">
                    <input wire:model.debounce.500ms="title" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                    @error('title') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex mb-4">
                <div class="w-1/4">
                    <label>
                    Description <i class="text-red-400">*</i>
                    </label>
                </div>

                <div class="w-3/4 dark:bg-gray-600" wire:ignore>
                    <trix-editor
                        class="form-input formatted-content"
                        x-ref="trix"
                        wire:model.debounce.500ms="description"
                        wire:key="desc"
                    >
                    </trix-editor>
                    @error('description') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            @if(!$faq)
            <div class="flex mb-4">
                <div class="w-1/4"></div>
                <div class="w-3/4">
                    <input wire:click.prevent="create" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Create">
                </div>
            </div>
            @else
            <div class="flex mb-4">
                <div class="w-1/4"></div>
                <div class="w-3/4">
                    <input wire:click.prevent="update" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Update">
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
@endsection
