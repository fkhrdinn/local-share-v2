<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Broadcast;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class BroadcastTable extends PowerGridComponent
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
        return Broadcast::query();
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
            ->addColumn('subject')
            ->addColumn('message', function (Broadcast $model){
                if (strlen($model->message) > 100) {
                    $data = substr($model->message, 0, 100);
                    return strip_tags($data);
                }
                return strip_tags($model -> message);
            })
            ->addColumn('user_id', function(Broadcast $model) {
                return User::where('id', $model->user_id)
                ->value('name');
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
                ->title(__('SUBJECT'))
                ->field('subject')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('MESSAGE'))
                ->field('message')
                ->sortable()
                ->makeInputText()
                ->searchable(),

            Column::add()
                ->title(__('USER NAME'))
                ->field('user_id')
                ->searchable()
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
          /*  Button::add('edit')
               ->caption(__('Edit'))
               ->class('bg-indigo-500 text-white')
               ->route('broadcast.edit', ['broadcast' => 'id']), */

           Button::add('destroy')
               ->caption(__('Delete'))
               ->class('bg-red-500 text-white text-sm rounded-3xl p-1 px-2 hover:bg-red-900')
               ->route('broadcasts.destroy', ['id' => 'id'])
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
           $updated = Broadcast::query()->find($data['id'])->update([
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
            Button::add('createBroadcast')
                ->caption('Create Broadcast')
                ->class('p-1 rounded-3xl text-sm shadow-lg bg-blue-400 px-2 text-white hover:bg-blue-800')
                ->route('broadcasts.create', [])
        ];
    }
}