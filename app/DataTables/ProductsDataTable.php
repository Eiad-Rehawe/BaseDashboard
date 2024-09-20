<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            return '<input id="checkbox" name="id[]"  type="checkbox" value="'.$query->id.'">';
           })
           ->addColumn('image',function($query){
            $image = $query->files()->first()->file_url ?? '';
            return "<img src='".$image."' height='80' width='80'>";
           })
           ->addColumn('qr',function($query){
            $row_1 = $query->id;
           return '    <a href="#export-pdf" class="btn btn-primary" id="'.$row_1 .'" onclick="Barcode(this)">'. __('table.barcode_generate') .'</a>
';
            // return view('backend.includes.qr',compact('row_1'));
           })
          
            ->editColumn('category_id',function($query){
             
                return $query->category!=null ? $query->category->getCategoryName() : '';
            })

            ->editColumn('weight_measurement_id',function($query){
               return $query->weight_measurement != null ? $query->weight_measurement->getMeasurment():'' ;
                
            })
            ->addColumn('action',function($query){
                $row = $query;
                return view('backend.includes.buttons',compact('row'));
            })
            ->addColumn('name',function($query){
               return  request()->segment(1) == 'ar' ? $query->name_ar : $query->name_en;
            })
            ->editColumn('review_avg',function($query){
                return $query->ratings()->avg('rating') ?? 0;
            })
           
            ->filterColumn('category_id', function ($query, $keywords) {
                return $query->whereHas('category', function($query) use($keywords) {
                    return $query->where('name_ar', 'LIKE', "%$keywords%")->orWhere('name_en', 'LIKE', "%$keywords%");
                });
            })
            ->filterColumn('name', function ($query, $keywords) {
                    return $query->where('name_ar', 'LIKE', "%$keywords%")->orWhere('name_en', 'LIKE', "%$keywords%");
            })
            ->rawColumns(['name','qr','weight_measurement_id','category_id','review_avg','image','action','ckeckbox']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        // return $model->newQuery();
        return $model->orderBy('id','desc')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('products-table')
                    ->columns($this->getColumns())
                    ->responsive(true)
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
                    ]);
                
    
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('ckeckbox')->title('<input type="checkbox" class="checkbox"  >')->exportable(false)->printable(false)->orderable(false)->searchable(false),
          
            Column::make('name')->title(trans('table.name'))->addClass('text-center'),
            Column::make('barcode_id')->title(trans('table.barcode_id'))->addClass('text-center'),
            Column::make('category_id')->title(trans('table.category'))->addClass('text-center'),
            Column::make('image')->title(trans('table.image'))->addClass('text-center'),
            Column::make('purchasing_price')->title(trans('table.purchasing_price'))->addClass('text-center'),
            Column::make('selling_price')->title(trans('table.selling_price'))->addClass('text-center'),
            Column::make('new_selling_price')->title(trans('table.new_selling_price'))->addClass('text-center'),
            Column::make('quantity')->title(trans('table.quantity'))->addClass('text-center'),
            Column::make('review_avg')->title(trans('table.review_avg'))->addClass('text-center'),
            Column::make('wight')->title(trans('table.weight'))->addClass('text-center'),
            Column::make('weight_measurement_id')->title(trans('table.weight_measurement'))->addClass('text-center'),
            Column::make('qr')->title(trans('table.qr_code_generate'))->addClass('text-center')->addClass('qr_'),
            Column::make('action')->title(trans('table.action')),
        ];
    }
  
    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
