<div>
    <div>
        <button onclick='Livewire.emit("openModal", "customer-details-modal", {{ json_encode(["customer" => $customer, "invoice" => $invoice ]) }})' class="text-white bg-blue-700 hover:bg-blue-800 rounded-full dark:bg-blue-600 dark:hover:bg-blue-700" type="button" @click = "customerModal = !customerModal">
            <i class="material-icons align-bottom">&#xe148;</i>
        </button>
        {{$customer->name}}
    </div>
    <div>
        <a class="text-blue-600 dark:text-blue-400" target="_blank" href="mailto:{{ $customer->email }}">{{$customer->email}}</a>
    </div>
    <div>
        <a class="text-blue-600 dark:text-blue-400" target="_blank" href="https://api.whatsapp.com/send?phone={{ $customer->mobile_phone }}">{{ $customer->mobile_phone }}</a>
    </div>
</div>