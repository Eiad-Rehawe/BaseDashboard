<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Fields\Checkbox;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
           
           ->editColumn('created_at',function($query){
            return $query->created;
           })
           ->editColumn('updated_at',function($query){
            return $query->created;
           })
        //    ->addColumn('ckeckbox',function($query){
        //     return '<input id="checkbox" name="id[]" type="checkbox" value="'.$query->id.'">';
        //    })
           ->editColumn('gender',function($query){
            return $query->gender();
           })
            // ->editColumn('action',function($query){
            //     $row = $query;
            //     return view('backend.includes.buttons',compact('row'));
            // })
            ->rawColumns(['ckeckbox','created_at','updated_at','gender']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                    ])
                    ->responsive(true);
                   
    }
 
    public function getColumns(): array
    {
        return [
            // Column::make('ckeckbox')->title('<input type="checkbox" class="checkbox"  >')->exportable(false)->printable(false)->orderable(false)->searchable(false),
            // Column::make('id'),
            Column::make('first_name')->title(trans('table.first_name')),
            Column::make('last_name')->title(trans('table.last_name')),
            Column::make('email')->title(trans('table.email')),
            Column::make('address')->title(trans('table.address')),
            Column::make('phone')->title(trans('table.phone')),
            Column::make('gender')->title(trans('table.gender')),
            Column::make('created_at')->title(trans('table.created_at')),
            Column::make('updated_at')->title(trans('table.updated_at')),
            // Column::make('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
