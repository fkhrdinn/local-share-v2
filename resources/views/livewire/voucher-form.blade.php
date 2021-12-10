<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" >
    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-800">
        <p class="font-bold text-lg">Create Voucher</p>
        <hr>

        <div class="md:flex sm:block">
            <div class="mt-4 md:w-1/2 sm:w-full">
                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label for="code">
                        Code
                        </label>
                        <label class=" block text-gray-400 text-sm">
                        Skip this field to auto generate.
                        </label>
                    </div>

                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="code" type="text" class="form-input uppercase rounded-3xl w-full dark:bg-gray-600">
                        @error('code') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Redemption Quantity <i class="text-red-400">*</i>
                        </label>
                    </div>

                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="quantity" type="number" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                        @error('quantity') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label for="type">
                        Type <i class="text-red-400">*</i>
                        </label>
                    </div>

                    <div class="w-3/4">
                        <select class="form-select rounded-3xl w-full dark:bg-gray-600" wire:model.debounce.500ms="type">
                            @foreach($types as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select> 
                        @error('type') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label for="value">
                        Value <i class="text-red-400">*</i>
                        </label>
                    </div>

                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="value" id="value" type="number" class="form-input rounded-3xl w-full dark:bg-gray-600" required>
                        @error('value') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>
            <div class="mt-4 md:ml-12 sm:ml-0 md:w-1/2 sm:w-full">
                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Minimum Amount
                        </label>
                    </div>

                    <div class="w-3/4">
                        <input wire:model.debounce.500ms="min_amount" type="number" class="form-input rounded-3xl w-full dark:bg-gray-600">
                        @error('min_amount') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Effective Date <i class="text-red-400">*</i>
                        </label>
                    </div>

                    <div class="w-3/4">
                        <input type="date" wire:model.debounce.500ms="effective_at" class="form-input rounded-3xl w-full bg-gray-200 dark:bg-gray-600" required>
                        @error('effective_at') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/4">
                        <label>
                        Expire At <i class="text-red-400">*</i>
                        </label>
                    </div>

                    <div class="w-3/4">
                        <input type="date" wire:model.debounce.500ms="expires_at" class="form-input rounded-3xl w-full bg-gray-200 dark:bg-gray-600" required>
                        @error('expires_at') <span class="error text-red-400 text-sm">{{ $message }}</span> @enderror 
                    </div>
                </div>
                @if(!$voucher)
                <div class="flex mb-4 mt-12">
                    <div class="w-1/4"></div>
                    <div class="w-3/4">
                        <input wire:click.prevent="create" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Create">
                    </div>
                </div>
                @else
                <div class="flex mb-4 mt-12">
                    <div class="w-1/4"></div>
                    <div class="w-3/4">
                        <input wire:click.prevent="update" type="submit" class="rounded-3xl w-full text-white hover:bg-green-700 bg-green-500 cursor-pointer h-10" value="Update">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>