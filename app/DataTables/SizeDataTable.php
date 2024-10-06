<?php
namespace App\DataTables;

use App\Models\Size;
use Yajra\DataTables\Services\DataTable;

class SizeDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'sizes.actions');
    }

    public function query(Size $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax()
            ->addAction(['width' => '80px', 'title' => 'Actions'])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[0, 'desc']],
                'buttons' => [],
            ]);
    }

    protected function getColumns()
    {
        return [
            'id',
            'name',
        ];
    }

    protected function filename(): string
    {
        return 'Sizes_' . date('YmdHis');
    }
}
