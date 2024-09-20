<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\Poster;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PostersDataTable extends DataTable
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
           ->editColumn('product_id',function($query){
            $lang = request()->segment(1);
          return  $query->product != null ? ($lang == 'ar' ? $query->product->name_ar : $query->product->name_en):'';

           })
           ->editColumn('category_id',function($query){
            $lang = request()->segment(1);
            return  $query->category != null ? ($lang == 'ar' ? $query->category->name_ar : $query->category->name_en):'';
           })
          
            ->addColumn('action',function($query){
                $row = $query;
                return view('backend.includes.buttons',compact('row'));
            })
            ->filterColumn('category_id', function ($query, $keywords) {
                return $query->whereHas('category', function($query) use($keywords) {
                    return $query->where('name_ar', 'LIKE', "%$keywords%")->orWhere('name_en', 'LIKE', "%$keywords%");
                });
            })
            ->filterColumn('product_id', function ($query, $keywords) {
                return $query->whereHas('product', function($query) use($keywords) {
                    return $query->where('name_ar', 'LIKE', "%$keywords%")->orWhere('name_en', 'LIKE', "%$keywords%");
                });
            })
            ->rawColumns(['product_id','category_id','action','ckeckbox']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Poster $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('posters-table')
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
            Column::make('category_id')->title(trans('table.category'))->addClass('text-center'),
            Column::make('product_id')->title(trans('table.product'))->addClass('text-center'),
            Column::make('price_discount')->title(trans('table.price_discount'))->addClass('text-center'),
            Column::make('Percentage_discount')->title(trans('table.Percentage_discount'))->addClass('text-center'),
            Column::make('action')->title(trans('table.action')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Posters_' . date('YmdHis');
    }
}
