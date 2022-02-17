<!-- Modal content -->
<div class="bg-white rounded-lg shadow relative dark:bg-gray-600">
    <!-- Modal header -->
    <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-white">
        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
            Customer Details
        </h3>
        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="customer-modal">
        <i class="material-icons">&#xe5cd;</i>  
        </button>
    </div>
    <!-- Modal body -->
    <div class="p-6 space-y-6">
        <div class="flex text-sm">
            <div class="w-2/6">
                <div class="mb-10 border-b pb-2">
                        Name
                </div>
                <div class="mb-10 border-b pb-2">
                        Email
                </div>
                <div class="mb-10 border-b pb-2">
                        Mobile Number
                </div>
                <div class="mb-10 border-b pb-2">
                        Address
                </div>
                <div class="mb-10 border-b pb-2">
                        Postcode
                </div>
                <div class="mb-10 border-b pb-2">
                        City
                </div>
                <div class="mb-10 border-b pb-2">
                        State
                </div>
                <div class="mb-10 border-b pb-2">
                        Tracking Number
                </div>
            </div>
            <div class="w-4/6">
                <div class="mb-10 border-b pb-2">
                    {{ $customer->name }}
                </div>
                <div class="mb-10 border-b pb-2">
                    {{ $customer->email }}
                </div>
                <div class="mb-10 border-b pb-2">
                    {{ $customer->mobile_phone }}
                </div>
                <div class="mb-10 border-b pb-2">
                    {{ $customer->address }}
                </div>
                <div class="mb-10 border-b pb-2">
                    {{ $customer->postcode }}
                </div>
                <div class="mb-10 border-b pb-2">
                    {{ $customer->city }}
                </div>
                <div class="mb-10 border-b pb-2">
                    {{ $customer->state }}
                </div>
                <div class="mb-10 border-b pb-2">
                    @if($invoice->tracking_number)
                        {{ $invoice->tracking_number }}
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</div>