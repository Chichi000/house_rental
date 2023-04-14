<?php

namespace App\DataTables;

use App\Models\Tenant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TenantsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $tenants = Tenant::withTrashed()->with(['users']);
        
        return datatables()
            ->eloquent($tenants)
            // ->addColumn('Edit', function ($row) {
            //     if ($row->deleted_at)
            //         return '<a class="btn btn-outline-secondary">Edit</a>';
            //     else
            //         return
            //             '<a href="' . route('editTenant', $row->id) . '" class="btn bg-gradient-primary">Edit</a>';
            // })
            ->addColumn('status', function ($tenants) {
                if ($tenants->deleted_at)
                    return '<span class="badge rounded-pill bg-secondary" style="color:white"> Deactivated </span>';
                else
                    return '<span class="badge rounded-pill bg-info" style="color:white"> Available </span>';
            })
            ->addColumn('Action', function ($row) {
                if ($row->deleted_at)
                    return '<a href="' . route('tenant.restore', $row->id) . '" class="btn bg-gradient-info">Restore</a>';
                else
                    return
                    '<form action="' . route('tenant.destroy', $row->id) . '" method="POST">' . csrf_field() . '
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-outline-danger float-end" type="submit">Delete</button>
                    </form>
                    <form action="' . route('tenant.deactivate', $row->id) . '" method="POST">' . csrf_field() . '
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn bg-gradient-danger" type="submit">Deactivate</button>
                    </form>';
            })
            ->addColumn('image', function ($tenants) {
                return '<img src="' . asset($tenants->imagePath) . '" width="80"height="80" class="rounded" >';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('m/d/Y - h:m A');
            })
            ->escapeColumns([]);
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Tenant $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tenant $model)
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
            ->setTableId('tenants-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->selectStyleSingle()
            ->orderBy(0)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('first_name')->title('First Name'),
            Column::make('last_name')->title('Last Name'),
            Column::make('status'),
            Column::make('image'),
            Column::make('created_at'),
            // Column::make('updated_at'),
            // Column::computed('Edit')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(30)
            //     ->addClass('text-center'),
            Column::computed('Action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Tenants_' . date('YmdHis');
    }
}