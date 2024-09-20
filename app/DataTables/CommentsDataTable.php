<?php

namespace App\DataTables;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CommentsDataTable extends DataTable
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
           ->editColumn('user_id',function($query){
            if(isset($query->user->id)){
                return $query->user->first_name .''.$query->user->last_name ? $query->user->first_name .''.$query->user->last_name : $query->user->email ;

            }
           })
        //    ->editColumn('custemor_id',function($query){
        //     return $query->custemor()->name ?? '';
        //    })
           ->editColumn('product_id',function($query){
            if(isset($query->product)){
                return request()->segment(1) == 'ar' ? $query->product->name_ar : $query->product->name_en;
            }
           })
            // ->addColumn('action',function($query){
            //     $row = $query;
            //     return view('backend.includes.buttons',compact('row'));
            // })
            ->filterColumn('user_id', function ($query, $keywords) {
                return $query->whereHas('user', function($query) use($keywords) {
                    return $query->where('first_name', 'LIKE', "%$keywords%")->orWhere('last_name', 'LIKE', "%$keywords%");
                });
            })
            ->filterColumn('product_id', function ($query, $keywords) {
                return $query->whereHas('product', function($query) use($keywords) {
                    return $query->where('name_ar', 'LIKE', "%$keywords%")->orWhere('name_en', 'LIKE', "%$keywords%");
                });
            })
            ->rawColumns(['user_id','product_id','ckeckbox']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Comment $model): QueryBuilder
    {
        return $model->orderBy('id','desc')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('comments-table')
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
            Column::make('comment')->title(trans('table.comment'))->addClass('text-center'),
            Column::make('user_id')->title(trans('table.user'))->addClass('text-center'),
            // Column::make('custemor_id')->title(trans('table.customers_mobile'))->addClass('text-center'),
            Column::make('product_id')->title(trans('table.product'))->addClass('text-center'),

            // Column::make('action')->title(trans('table.action')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Comments_' . date('YmdHis');
    }
}
