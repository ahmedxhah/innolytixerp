<?php

namespace App\DataTables;

use App\Models\Quotations;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class QuotationsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'quotations.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Quotations $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Quotations $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                       'extend' => 'create',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                    ],
                    [
                       'extend' => 'export',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                    ],
                    [
                       'extend' => 'print',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
                    ],
                    [
                       'extend' => 'reset',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                    ],
                    [
                       'extend' => 'reload',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-refresh"></i> ' .__('auth.app.reload').''
                    ],
                ],
                 'language' => [
                   'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/English.json'),
                 ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'client_id' => new Column(['title' => __('models/quotations.fields.client_id'), 'data' => 'client_id']),
            'officedetails_id' => new Column(['title' => __('models/quotations.fields.officedetails_id'), 'data' => 'officedetails_id']),
            'created_by' => new Column(['title' => __('models/quotations.fields.created_by'), 'data' => 'created_by']),
            'date' => new Column(['title' => __('models/quotations.fields.date'), 'data' => 'date']),
            'subject' => new Column(['title' => __('models/quotations.fields.subject'), 'data' => 'subject']),
            'sub_total' => new Column(['title' => __('models/quotations.fields.sub_total'), 'data' => 'sub_total']),
            'discount' => new Column(['title' => __('models/quotations.fields.discount'), 'data' => 'discount']),
            'tax' => new Column(['title' => __('models/quotations.fields.tax'), 'data' => 'tax']),
            'grand_total' => new Column(['title' => __('models/quotations.fields.grand_total'), 'data' => 'grand_total'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'quotations_datatable_' . time();
    }
}
