<?php

namespace App\DataTables;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action',function($row){

                $btn ='<div class="d-flex justify-content-between m-3">
                <a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>
                <a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>
                </div>';


                 return $btn;
         })
         ->rawColumns(['action']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model): QueryBuilder
    {
        return $model->newQuery()->select('first_name','last_name','designation','permanent_address','created_at','updated_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('employeedatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->addAction([
                        'defaultContent' => '',
    'data'           => 'action',
    'name'           => 'action',
    'title'          => 'Action',
    'render'         => null,
    'orderable'      => false,
    'searchable'     => false,
    'exportable'     => false,
    'printable'      => true,
    'footer'         => '',
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
             [
                  'data' => null,
                  'defaultContent' => ' - ',
                  'className' => 'select-checkbox',
                  'title' => ' ',
                  'orderable' => true,
                  'searchable' => true,
             ] ,
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('designation'),
            Column::make('permanent_address'),
            Column::make('created_at'),
            Column::make('updated_at')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Employee_' . date('YmdHis');
    }
}
