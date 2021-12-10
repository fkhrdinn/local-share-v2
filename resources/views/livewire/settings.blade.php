<div>
    <div class="grid grid-cols-1 gap-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12 dark:bg-gray-800 dark:text-white dark:border-gray-800">
            <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
                <p class="font-bold text-lg">Profile</p>
                <hr>

                <div class="mt-4">
                    <div class="flex mb-4">
                        <div class="w-1/4">
                            <label>
                            Name <i class="text-red-400">*</i>
                            </label>
                        </div>
                        <div class="w-3/4">
                            <input wire:model.debounce.500ms="userName" type="text" disabled class="form-input cursor-not-allowed rounded-3xl w-full bg-gray-200 dark:bg-gray-300" required>
                            @error('userName') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4">
                            <label>
                                Email <i class="text-red-400">*</i>
                            </label>
                        </div>
                        <div class="w-3/4">
                            <input wire:model.debounce.500ms="email" type="text" disabled class="form-input cursor-not-allowed rounded-3xl w-full bg-gray-200 dark:bg-gray-300" required>
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
                                    <img src="{{ $logo->temporaryUrl() }}" alt="temp" style="width:250px;height:200px">
                                </div>
                            </div>
                        @elseif($logos)
                            <div class="flex mb-4">
                                <div class="w-1/4"></div>
                                <div class="w-3/4">
                                    <img src="{{ $logos }}" alt="temp" style="width:250px;height:200px">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4">
                            <label>
                                Facebook
                                @if(!$facebook)
                                <p class="text-xs text-gray-400">( URL )</p>
                                @else
                                <a href="{{ $facebook }}" class="block text-xs text-gray-400 dark:hover:text-white hover:text-black" target="_blank">View</a>
                                @endif
                            </label>
                        </div>
                        <div class="w-3/4">
                            <input wire:model.debounce.500ms="facebook" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                            @error('facebook') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4">
                            <label>
                                Twitter
                                @if(!$twitter)
                                <p class="text-xs text-gray-400">( URL )</p>
                                @else
                                <a href="{{ $twitter }}" class="block text-xs text-gray-400 dark:hover:text-white hover:text-black" target="_blank">View</a>
                                @endif
                            </label>
                        </div>
                        <div class="w-3/4">
                            <input wire:model.debounce.500ms="twitter" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                            @error('twitter') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4">
                            <label>
                                Instagram
                                @if(!$instagram)
                                <p class="text-xs text-gray-400">( URL )</p>
                                @else
                                <a href="{{ $instagram }}" class="block text-xs text-gray-400 dark:hover:text-white hover:text-black" target="_blank">View</a>
                                @endif
                            </label>
                        </div>
                        <div class="w-3/4">
                            <input wire:model.debounce.500ms="instagram" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                            @error('instagram') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4"></div>
                        <div class="w-3/4">
                            <input wire:click.prevent="updateProfile" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Update">
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8 sm:grid-cols-1">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12 dark:bg-gray-800 dark:text-white dark:border-gray-800">
            <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
                <p class="font-bold text-lg">Password</p>
                <hr>
                
                <div class="mt-4">
                    <div class="flex mb-4">
                        <div class="w-1/4">
                            <label>
                            Current Password <i class="text-red-400">*</i>
                            </label>
                        </div>
                        
                        <div class="w-3/4">
                            <input wire:model.debounce.500ms="currentPassword" type="password" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                            @error('currentPassword') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4">
                            <label>
                            New Password <i class="text-red-400">*</i>
                            </label>
                        </div>

                        <div class="w-3/4">
                            <input wire:model.debounce.500ms="newPassword" type="password" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4">
                            <label>
                            Confirm Password <i class="text-red-400">*</i>
                            </label>
                        </div>

                        <div class="w-3/4">
                            <input wire:model.debounce.500ms="confirmPassword" type="password" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                            @error('confirmPassword') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4"></div>
                        <div class="w-3/4">
                            <input wire:click.prevent="updatePassword" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Update">
                        </div>
                    </div>
                </div> 

            </div>
        </div>
    
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12 dark:bg-gray-800 dark:text-white dark:border-gray-800">
            <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
                <p class="font-bold text-lg">Dark Mode</p>
                <hr>

                <div class="mt-4">
                    <div class="flex mb-4">
                        <div class="w-1/4">
                            <i class="material-icons icon-color">&#xe430;</i>
                            <label class="switch relative inline-block w-10 h-4 mr-4">
                                <input type="checkbox" class="form-checkbox" wire:model="darkMode" value="dark" @if($darkMode=='dark') checked="checked" @endif>
                                <span class="slider cursor-pointer inset-0 absolute round rounded-full"></span>
                            </label>
                            <i class="material-icons -ml-4">&#xef5e;</i>
                        </div>
                        <div class="w-3/4">
                            <input wire:click.prevent="updateTheme" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Update">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@section('css')
<style>
    .icon-color {
        color:rgba(241, 214, 147, 1);
    }
</style>
@endsection