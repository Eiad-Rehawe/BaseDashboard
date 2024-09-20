<?php

namespace App\DataTables;

use App\Models\Complaint;
use App\Models\Complaints;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ComplaintsDataTable extends DataTable
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
           ->editColumn('employee_id',function($query){
            $email = '';
            $row ='';

            if(!empty($query->employee->email)){
                $email = $query->employee->name;
                $row = $query;
                return "<a href='".route('backend.complaints.show',$row->id)."'>".$query->employee->email ."</a>";
            }else{
             return "<a href=''></a>";
            }
        
           })

           ->filterColumn('employee_id', function ($query, $keywords) {
            return $query->whereHas('employee', function($query) use($keywords) {
                return $query->where('name', 'LIKE', "%$keywords%")->orWhere('email', 'LIKE', "%$keywords%");
            });
        })
      
            ->rawColumns(['employee_id','ckeckbox']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Complaints $model): QueryBuilder
    {
        return $model->orderBy('id','desc')->newQuery();
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
            Column::make('employee_id')->title(trans('table.employee'))->addClass('text-center'),
            Column::make('complaint_date')->title(trans('table.complaint_date'))->addClass('text-center'),
            
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
