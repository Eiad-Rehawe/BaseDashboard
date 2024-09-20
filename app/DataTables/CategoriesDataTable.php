<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
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
            ->addColumn('action',function($query){
                $row = $query;
                return view('backend.includes.buttons',compact('row'));
            })
            ->editColumn('parent_id',function($query){
                if(!empty($query->parent)){
                    return App::getLocale() == 'ar' ? $query->parent->name_ar : $query->parent->name_en;

                }else{
                    return '';
                }
            })
          
            
            ->addColumn('image',function($query){
                $image = '';
                if(!empty($query->files()->first()->category_url)){
                    $image = $query->files()->first()->category_url;
                }else{
                    $image = '';
                }
                return "<img src='".$image."' height='80' width='80'>";
               })
               ->filterColumn('name', function ($query, $keyword) {
                return  $query->where('name_ar', 'like', "%$keyword%")
                      ->orWhere('name_en', 'like', "%$keyword%");
              })
            ->rawColumns(['action','ckeckbox','image','name']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->getDataAsLang()->orderBy('id','desc')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('categories-table')
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
            Column::make('name')->title(trans('table.name'))->addClass('text-center'),
            Column::make('image')->title(trans('table.image'))->addClass('text-center'),
            Column::make('parent_id')->title(trans('table.Parent'))->addClass('text-center'),
            Column::make('action')->title(trans('table.action')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}
