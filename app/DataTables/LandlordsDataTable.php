<?php

namespace App\DataTables;

use App\Models\Landlord;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Auth;

class LandlordsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable($query): EloquentDataTable
    {
        $landlords = Landlord::withTrashed()->with(['users','properties']);
        // $landlords = Landlord::withTrashed()->with(['users','properties'])->orderBy('id','DESC');

        return datatables()
            ->eloquent($landlords)
            ->addColumn('status', function ($landlords) {
                if ($landlords->deleted_at)
                    return '<span class="badge rounded-pill bg-secondary" style="color:white"> Deactivated </span>';
                else
                    return '<span class="badge rounded-pill bg-info" style="color:white"> Active </span>';
            })
            ->addColumn('Action', function ($row) {
                if ($row->deleted_at)
                    return '<a href="' . route('landlord.restore', $row->id) . '" class="btn bg-gradient-info">Restore</a>';

                else
                    return
                    '<form action="' . route('landlord.destroy', $row->id) . '" method="POST">' . csrf_field() . '
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-outline-danger float-end" type="submit">Delete</button>
                    </form>
                    <form action="' . route('landlord.deactivate', $row->id) . '" method="POST">' . csrf_field() . '
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn bg-gradient-danger" type="submit">Deactivate</button>
                    </form>';
            })
            ->addColumn('Verify', function ($row) {
                if (Auth::user()->role == 'admin') {
                    if ($row->is_upgraded == 1)
                        return '<button href="" class="btn bg-gradient-info"  disabled>Verified</button>';
                    else
                        return
                            '<form action="' . route('landlord.verified', $row->id) . '" method="POST">' . csrf_field() . '
                    <input name="_method" type="hidden" >
                    <button  class="btn bg-gradient-success" type="submit">Verified</button>
                    </form>';
                }
            })
            ->addColumn('properties', function (Landlord $landlords) {
                return $landlords->properties->map(function($property) {
                return "<li>".$property->area. "</li>";
                })->implode('<br>');
            })
            ->addColumn('image', function ($landlords) {
                return '<img src="' . asset($landlords->imagePath) . '" width="80"height="80" class="rounded" >';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('m/d/Y - h:m A');
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Landlord $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Landlord $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('landlords-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    // ->selectStyleSingle()
                    ->buttons([
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('first_name')->title('First Name'),
            Column::make('last_name')->title('Last Name'),
            // Column::make('properties')->name('properties.area')->title('Property')->orderable(false),
            Column::make('properties')->name('properties.area')->title('Property list'),
            Column::make('status'),
            Column::make('image'),
            Column::make('created_at'),
            Column::make('Verify'),
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
    protected function filename(): string
    {
        return 'Landlords_' . date('YmdHis');
    }
}
