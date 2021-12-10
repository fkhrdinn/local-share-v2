<div>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
            <p class="font-bold text-lg">Create Category</p>
            <hr>
            
            <div class="mt-4">
                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Product Category <i class="text-red-400">*</i>
                        </label>
                    </div>
                    
                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="type" type="text" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
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
</div>
