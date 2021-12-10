@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">       
@endsection
<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" >
        <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
            <p class="font-bold text-lg">Create Broadcast</p>
            <hr>

            <div class="mt-4">
                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Subject <i class="text-red-400">*</i>
                        </label>
                    </div>

                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="subject" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" autocomplete="off" required>
                        @error('subject') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Message <i class="text-red-400">*</i>
                        </label>
                    </div>

                    <div class="w-3/4 dark:bg-gray-600" wire:ignore>
                        <trix-editor
                            class="form-input formatted-content"
                            x-ref="trix"
                            wire:model.debounce.500ms="message"
                            wire:key="desc"
                        >
                        </trix-editor>
                        @error('message') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Email
                        <p class="text-gray-400 text-sm">Selected Email(s) -> {{ count($checkedEmail) + count($allEmailCount) }}</p>
                        </label>
                    </div>

                    <div class="w-3/4">
                        <!-- Email toggle -->
                        <button class="w-full block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center" type="button" 
                        data-modal-toggle="email-modal">
                            Select Email
                        </button>
                    </div>
                </div>

                <div x-data={show:false}>
                    <div class="flex mb-4 justify-start">
                        <div @click="show=!show">
                            <button type="button" class="text-white bg-gray-600 hover:bg-gray-800 font-medium 
                            rounded-xl text-xs px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Advanced Filter (Optional)</button>
                        </div>
                    </div>

                    <div class="flex mb-4" x-show="show">
                        <div class="w-1/4">
                            <label>
                            State
                            <p class="text-gray-400 text-sm">Selected Email(s) -> {{ count($checkedState) }} </p>
                            </label>
                        </div>

                        <div class="w-3/4">
                            <!-- State toggle -->
                            <button class="w-full block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center" type="button" 
                            data-modal-toggle="state-modal">
                                Select State
                            </button>
                        </div>
                    </div>

                    <div class="flex mb-4" x-show="show">
                        <div class="w-1/4">
                            <label>
                            Schedule Date
                            </label>
                        </div>

                        <div class="w-3/4">
                            <input wire:model.debounce.500ms="scheduleDate" type="datetime-local" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                            @error('scheduleDate') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4"></div>
                    <div class="w-3/4">
                        <input wire:click.prevent="create" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Create">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Email modal -->
    <div id="email-modal" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center" wire:ignore.self>
        <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow relative">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl lg:text-2xl font-semibold">
                        Select Email
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="email-modal">
                        <i class="material-icons">&#xe5cd;</i>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex mb-4">
                        <div class="w-2/4">
                            <label>
                            Search Email
                            <p class="text-gray-400 text-sm">Selected Email(s) -> {{ count($checkedEmail) + count($allEmailCount) }}</p>
                            </label>
                        </div>

                        <div class="w-2/4">
                            <input wire:model.debounce.500ms="searchEmail" id="searchEmail" type="text" class="form-input rounded-3xl w-full" 
                            @if($checkedAllEmail == 'Select All') disabled style="cursor:not-allowed" @endif autocomplete="off" required>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        @if (!empty($results))
                        <div class ="w-full h-32 overflow-y-scroll">
                            @foreach ($results as $result)
                                <input class="ml-5 mr-5 rounded-3xl" wire:model="checkedEmail" type="checkbox" value="{{$result->email}}">
                                <label class="text-md">{{$result->email}}</label>
                                <br>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="flex mb-4">
                        <div class ="w-full">
                            <input class="ml-5 mr-5 rounded-3xl" wire:model="checkedAllEmail" type="checkbox" value="Select All">
                            <label>Select All Email</span>
                            <br>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex space-x-2 items-center p-6 border-t border-gray-200 rounded-b">
                    <button data-modal-toggle="email-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
                    <button type="button" wire:click.prevent="resetEmail" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                    dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <!-- State modal -->
    <div id="state-modal" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center" wire:ignore.self>
        <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow relative">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl lg:text-2xl font-semibold">
                        Select State
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="state-modal">
                        <i class="material-icons">&#xe5cd;</i>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex mb-4">
                        <div class="w-2/4">
                            <label for="searchEmail">
                            State
                            <p class="text-gray-400 text-sm">Selected State(s) -> {{ count($checkedState) }} </p>
                            </label>
                        </div>

                        <div class="w-2/4">
                            <div class ="w-full h-32 overflow-y-scroll">
                                @foreach ($states as $state)
                                    <input class="ml-5 mr-5 rounded-3xl" wire:model="checkedState" type="checkbox" value="{{$state->state}}"
                                    @if($checkedAllEmail == 'Select All') disabled style="cursor:not-allowed" @endif>
                                    <label class="text-md">{{$state->state}}</label>
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex space-x-2 items-center p-6 border-t border-gray-200 rounded-b">
                    <button data-modal-toggle="state-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
                    <button type="button" wire:click.prevent="resetState" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                    dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
@endsection