<?php

namespace App\DataTables;

use App\Models\Complaints;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ComplaimentUsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('ckeckbox', function ($query) {
                return '<input id="checkbox" name="id[]" type="checkbox" value="' . $query->id . '">';
            })

            ->editColumn('customer_id', function ($query) {
                $email = '';
                $row = '';
                if (!empty($query->customer->email)) {
                    $email = $query->customer->first_name . ' ' . $query->customer->last_name;
                    $row = $query;
                    return "<a href='" . route('backend.complaints.show', $row->id) . "'>" . $email . "</a>";
                } else {
                    return "<a href=''></a>";
                }

            })
            ->editColumn('status', function ($query) {
                return $query->status();
            })
            ->editColumn('product_id', function ($query) {
                if (!empty($query->product_id)) {
                return request()->segment(1) == 'ar' ? $query->product->name_ar : $query->product->name_en;
                }else{
                    return null;
                }
            })
            ->filterColumn('product_id', function ($query, $keywords) {
                return $query->whereHas('product', function($query) use($keywords) {
                    return $query->where('name_ar', 'LIKE', "%$keywords%")->orWhere('name_en', 'LIKE', "%$keywords%");
                });
            })
            ->filterColumn('customer_id', function ($query, $keywords) {
                return $query->whereHas('customer', function($query) use($keywords) {
                    return $query->where('first_name', 'LIKE', "%$keywords%")->orWhere('last_name', 'LIKE', "%$keywords%");
                });
            })
          
            ->rawColumns(['status', 'customer_id', 'ckeckbox']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Complaints $model): QueryBuilder
    {
        return   $query = $model->orderBy('status','desc')->newQuery();

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('complaints-table')
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
            Column::make('customer_id')->title(trans('table.customer'))->addClass('text-center'),
            Column::make('product_id')->title(trans('table.product'))->addClass('text-center'),
            Column::make('cause_problem')->title(trans('table.cause_problem'))->addClass('text-center'),
            Column::make('employee_name')->title(trans('table.employee_name'))->addClass('text-center'),
            Column::make('status')->title(trans('table.status_complaiment'))->addClass('text-center'),

            Column::make('complaint_date')->title(trans('table.complaint_date'))->addClass('text-center'),
            // Column::make('complaint_text')->title(trans('table.complaint_text'))->addClass('text-center text-wrap'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Complaints_' . date('YmdHis');
    }
}
