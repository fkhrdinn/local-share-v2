<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
            <p class="font-bold text-lg">Password</p>
            <hr>
            
            <div class="mt-4">
                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label for="password">
                        Current Password
                        </label>
                    </div>
                    
                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="currentPassword" id="password" type="password" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label for="newPassword">
                        New Password
                        </label>
                    </div>

                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="newPassword" id="newPassword" type="password" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label for="confirmPassword">
                        Confirm Password  
                        </label>
                    </div>

                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="confirmPassword" id="confirmPassword" type="password" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
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


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12">
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

@section('css')
<style>
    .icon-color {
        color:rgba(241, 214, 147, 1);
    }
</style>
@endsection