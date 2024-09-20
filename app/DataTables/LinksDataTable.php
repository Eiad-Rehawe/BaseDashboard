<?php

namespace App\DataTables;

use App\Models\Link;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LinksDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('ckeckbox',function($query){
            return '<input id="checkbox" name="id[]" type="checkbox" value="'.$query->id.'">';
           })
           ->editColumn('icon_id',function($query){
            return $query->icon->name;
           })
           ->addColumn('action',function($query){
            $row = $query;
            return view('backend.includes.buttons',compact('row'));
        })
            
            ->rawColumns(['ckeckbox','action','icon_id']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Link $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('links-table')
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('ckeckbox')->title('<input type="checkbox" class="checkbox"  >')->exportable(false)->printable(false)->orderable(false)->searchable(false),
            Column::make('name')->title(trans('table.code'))->addClass('text-center'),
            Column::make('link')->title(trans('table.value'))->addClass('text-center'),
            Column::make('icon_id')->title(trans('table.expired_date'))->addClass('text-center'),
            Column::make('action')->title(trans('table.action')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Links_' . date('YmdHis');
    }
}
