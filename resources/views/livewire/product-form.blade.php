@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">       
@endsection
<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
            <div class="flex">
                <div class="w-1/2 mr-8">
                    <p class="font-bold text-lg">Basic Information</p>
                    <hr>
                    
                    <div class="mt-4">
                        <div class="flex mb-4">
                            <div class="w-1/4">
                                <label>
                                Product Name
                                </label>
                            </div>
                            
                            <div class="w-3/4">
                                <input wire:model.debounce.500ms="productName" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                            </div>
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/4">
                                <label>
                                Product Description
                                </label>
                            </div>

                            <div class="w-3/4 dark:bg-gray-600" wire:ignore>
                                <trix-editor
                                    class="form-input formatted-content"
                                    x-ref="trix"
                                    wire:model.debounce.500ms="productDescription"
                                    wire:key="desc"
                                >
                                </trix-editor>
                            </div>
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/4">
                                <label>
                                Normal Price
                                </label>
                            </div>

                            <div class="w-3/4">
                                <input wire:model.debounce.500ms="price" type="number" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                            </div>
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/4">
                                <label>
                                Stock
                                </label>
                            </div>

                            <div class="w-3/4">
                                <input wire:model.debounce.500ms="stock" type="number" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="w-1/2 ml-8">
                    <p class="font-bold text-lg">Media Management</p>
                    <hr>

                    <div class="mt-4">
                        <div
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <div class="flex mb-4">
                                <div class="w-1/4">
                                    <label>
                                    Cover Photo
                                    </label>
                                </div>

                                <div class="w-3/4">
                                    <input wire:model="coverPhoto" type="file" class="form-input rounded-3xl w-full shadow-xl dark:bg-gray-400" required>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>

                            @if($coverPhoto)
                                <div class="flex mb-4">
                                    <div class="w-1/4"></div>
                                    <div class="w-3/4">
                                        <img src="{{ $coverPhoto->temporaryUrl() }}" alt="temp" class="w-1/3 h-4/12">
                                    </div>
                                </div>
                            @elseif($coverPhotos)
                                <div class="flex mb-4">
                                    <div class="w-1/4"></div>
                                    <div class="w-3/4">
                                        <img src="{{ $coverPhotos }}" alt="temp" class="w-1/3 h-4/12">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">

                            <div class="flex mb-4">
                                <div class="w-1/4">
                                    <label>
                                    Product Images
                                    </label>
                                </div>

                                <div class="w-3/4">
                                    <input wire:model="productImage" type="file" class="form-input rounded-3xl w-full shadow-xl dark:bg-gray-400" multiple>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>

                            <div class="flex mb-4">
                            <div class="w-1/4"></div>
                                <div class="w-3/4 grid grid-cols-3 gap-8">
                                    @if($productImage)
                                            @foreach($productImage as $image)
                                                <img src="{{ $image->temporaryUrl() }}" alt="temp" style="width:150px;height:100px">
                                            @endforeach
                                    @endif

                                    @if($productImages)
                                            @foreach($productImages as $key => $image)
                                            <div>
                                                <img src="{{ $image->getFullUrl() }}" alt="temp" style="width:150px;height:100px">
                                                <label class="switch relative inline-block w-10 h-4 mr-4 mt-4">
                                                    <input type="checkbox" class="form-checkbox" wire:model="deletedImages" value="{{ $image->id }}">
                                                    <span class="slider cursor-pointer inset-0 absolute round rounded-full"></span>
                                                    <p class="text-red-600 text-sm">Delete</p>
                                                </label>
                                            </div>
                                            @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <p class="font-bold text-lg">Others</p>
                    <hr>

                    <div class="mt-4">
                        <div class="flex mb-4">
                            <div class="w-1/4">
                                <label>
                                Product Category
                                </label>
                            </div>

                            <div class="w-3/4">
                                <select class="form-select rounded-3xl w-full dark:bg-gray-600" wire:model.debounce.500ms="category">
                                    <option value="">Select Type</option>
                                @foreach($categories as $type)
                                    <option value="{{$type->id}}"> {{$type->type}} </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mt-4">
                <hr>
                @if(!$product)
                <div class="flex justify-end mt-4">
                    <div class="w-1/12">
                        <input wire:click.prevent="create" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Submit">
                    </div>
                </div>
                @else
                <div class="flex justify-end mt-4">
                    <div class="w-1/12">
                        <input wire:click.prevent="update" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Update">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
@endsection