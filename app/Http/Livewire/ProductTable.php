<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class ProductTable extends PowerGridComponent
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
            ->showRecordCount();
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
        return Product::query();
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
            ->addColumn('photo', function(Product $model) {
                return view('vendor.datatable.product-image', ['product' => $model]);
            })
            ->addColumn('name')
            ->addColumn('price')
            ->addColumn('quantity')
            ->addColumn('merchant_id', function(Product $model) {
                return User::where('id', $model->merchant_id)
                ->value('name');
            })
            ->addColumn('category_id', function(Product $model) {
                return Category::where('id', $model->category_id)
                ->value('type');
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
                ->title(__('PRODUCT PHOTO'))
                ->field('photo'),

            Column::add()
                ->title(__('PRODUCT NAME'))
                ->field('name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('NORMAL PRICE'))
                ->field('price')
                ->sortable()
                ->searchable()
                ->makeInputRange(),

            Column::add()
                ->title(__('STOCK LEFT'))
                ->field('quantity')
                ->makeInputRange(),

            Column::add()
                ->title(__('MERCHANT NAME'))
                ->searchable()
                ->field('merchant_id')
                ->makeInputText(),

            Column::add()
                ->title(__('PRODUCT CATEGORY'))
                ->makeInputText()
                ->searchable()
                ->field('category_id'),
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

    
    public function actions(): array
    {
       return [
               Button::add('edit')
               ->caption(__('Edit'))
               ->class('bg-indigo-500 text-sm rounded-3xl text-white p-1 px-2 hover:bg-indigo-900')
               ->route('product.edit', ['product' => 'id']), 

               Button::add('destroy')
               ->caption(__('Delete'))
               ->class('bg-red-500 text-white text-sm rounded-3xl p-1 px-2 hover:bg-red-900')
               ->route('product.destroy', ['id' => 'id'])
               ->method('delete')
        ];
    }
    

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
           $updated = Product::query()->find($data['id'])->update([
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

    public function header(): array
    {
        return [
            Button::add('createProduct')
                ->caption('Create Product')
                ->class('p-1 rounded-3xl text-sm shadow-lg bg-blue-400 px-2 text-white hover:bg-blue-800')
                ->route('product.create', [])
        ];
    }

}
