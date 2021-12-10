<div>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
            <p class="font-bold text-lg">Update Merchant</p>
            <hr>
            
            <div class="mt-4">
                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Merchant's Name <i class="text-red-400">*</i>
                        </label>
                    </div>
                    
                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="merchantName" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                        @error('merchantName') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Email <i class="text-red-400">*</i>
                        </label>
                    </div>
                    
                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="email" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                        @error('email') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Mobile Phone <i class="text-red-400">*</i>
                        </label>
                    </div>
                    
                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="mobileNumber" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                        @error('mobileNumber') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
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
                            Profile Photo
                            </label>
                        </div>

                        <div class="w-3/4">
                            <input wire:model="logo" type="file" class="form-input rounded-3xl w-full shadow-xl dark:bg-gray-400" required>
                            @error('logo') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>

                    @if($logo)
                        <div class="flex mb-4">
                            <div class="w-1/4"></div>
                            <div class="w-3/4">
                                <img src="{{ $logo->temporaryUrl() }}" alt="temp" style="width:150px;height:100px">
                            </div>
                        </div>
                    @elseif($logos)
                        <div class="flex mb-4">
                            <div class="w-1/4"></div>
                            <div class="w-3/4">
                                <img src="{{ $logos }}" alt="temp" style="width:150px;height:100px">
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4"></div>
                    <div class="w-3/4">
                        <input wire:click.prevent="update" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Update">
                    </div>
                </div>
            </div> 

        </div>
    </div>
</div>
