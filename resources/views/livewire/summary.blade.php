<div class="gap-8 grid grid-cols-3 mb-8">
    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-800 sm:rounded-lg">
        <div class="flex"><i class="material-icons text-blue-600 text-5xl mr-12">&#xe8e5;</i>
            <div class="flex-wrap">
                <div class="text-gray-400 text-sm">Total Sales (RM)</div>
                <h4>
                    <span class="text-black text-md font-bold">
                        RM {{ number_format($this->total->total_sales ?? 0, 2) }}
                    </span>
                </h4>
            </div>
        </div>
    </div>
    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-800 sm:rounded-lg">
        <div class="flex"><i class="material-icons text-red-600 text-5xl mr-12">&#xe54e;</i>
            <div class="flex-wrap">
                <div class="text-gray-400 text-sm">Total Sales After Discount (RM)</div>
                <h4>
                    <span class="text-black text-md font-bold">
                        RM {{ number_format($this->total_sales_discount ?? 0, 2) }}
                    </span>
                </h4>
            </div>
        </div>
    </div>
    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-800 sm:rounded-lg">
        <div class="flex"><i class="material-icons text-green-600 text-5xl mr-12">&#xe8cb;</i>
            <div class="flex-wrap">
                <div class="text-gray-400 text-sm">Total Orders</div>
                <h4>
                    <span class="text-black text-md font-bold">
                        {{ $this->total->total_order ?? 0 }}
                    </span>
                </h4>
            </div>
        </div>
    </div>
</div>
<div class="gap-8 grid grid-cols-2 mb-8">
    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-800 sm:rounded-lg">
        <div class="flex"><i class="material-icons text-orange-400 text-5xl mr-12">&#xe7fd;</i>
            <div class="flex-wrap">
                <div class="text-gray-400 text-sm">Total Merchants</div>
                <h4>
                    <span class="text-black text-md font-bold">
                        {{ $this->total_merchant }}
                    </span>
                </h4>
            </div>
        </div>
    </div>
    <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-800 sm:rounded-lg">
        <div class="flex"><i class="material-icons text-green-300 text-5xl mr-12">&#xe179;</i>
            <div class="flex-wrap">
                <div class="text-gray-400 text-sm">Total Products</div>
                <h4>
                    <span class="text-black text-md font-bold">
                        {{ $this->total_product }}
                    </span>
                </h4>
            </div>
        </div>
    </div>
</div>
