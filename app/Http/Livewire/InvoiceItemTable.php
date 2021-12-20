<?php

namespace App\Http\Livewire;

use App\Models\Status;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\InvoiceItem;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class InvoiceItemTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp()
    {
        $this->showCheckBox()
            ->showPerPage()
            ->showExportOption('download', ['excel', 'csv'])
            ->showSearchInput();
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Builder
    {
        return InvoiceItem::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
        ->addColumn('customer', function(InvoiceItem $model) {
            $invoice = Invoice::find($model->invoice_id);
            $customer = Customer::find($invoice->customer_id);
            return view('vendor.datatable.customer-detail', ['customer' => $customer, 'invoice' => $invoice]);
        })
        ->addColumn('product', function(InvoiceItem $model) {
            $product = Product::find($model->product_id);
            return view('vendor.datatable.product-invoice', ['invoice' => $model, 'product' => $product]);
        })
        ->addColumn('shipping_fee', function(InvoiceItem $model) {
            $invoice = Invoice::where('id', $model->invoice_id)->value('shipping_fee');
            return 'RM '.$invoice;
        })
        ->addColumn('amount', function(InvoiceItem $model) {
            $price = $model->price * $model->quantity;
            return 'RM '.$price;
        })
        ->addColumn('invoice_code', function(InvoiceItem $model) {
            $invoice = Invoice::where('id', $model->invoice_id)->value('invoice_code');
            return $invoice;
        })
        ->addColumn('paid_at_formatted', function(InvoiceItem $model) { 
            $invoice = Invoice::where('id', $model->invoice_id)->first();
            $date = Carbon::parse($invoice->paid_at)->format('d/m/Y H:i:s');
            return $date;
        })
        ->addColumn('status', function(InvoiceItem $model) {
            $invoice = Invoice::find($model->invoice_id);
            $status = Status::find($invoice->status_id);
            return $status->name;
        });    
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */
    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('CUSTOMER'))
                ->field('customer')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('PRODUCT'))
                ->field('product')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('SHIPPING FEE'))
                ->field('shipping_fee')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('TOTAL AMOUNT'))
                ->field('amount')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('INVOICE CODE'))
                ->field('invoice_code')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('PAID AT'))
                ->field('paid_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('paid_at'),

            Column::add()
                ->title(__('STATUS'))
                ->field('status')
                ->searchable()
                ->sortable(),
        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable this section only when you have defined routes for these actions.
    |
    */

    /*
    public function actions(): array
    {
       return [
           Button::add('edit')
               ->caption(__('Edit'))
               ->class('bg-indigo-500 text-white')
               ->route('invoice-item.edit', ['invoice-item' => 'id']),

           Button::add('destroy')
               ->caption(__('Delete'))
               ->class('bg-red-500 text-white')
               ->route('invoice-item.destroy', ['invoice-item' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable this section to use editOnClick() or toggleable() methods
    |
    */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = InvoiceItem::query()->find($data['id'])->update([
                $data['field'] => $data['value']
           ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status, string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field' => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field' => __('Error updating custom field.'),
            ]
        ];

        return ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);
    }
    */

    public function template(): ?string
    {
        return null;
    }

}
