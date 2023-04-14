<?php

namespace App\DataTables;

use App\Models\Property;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Auth;

class PropertiesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable($query): EloquentDataTable
    {   
        if(auth::user()->role == 'landlord'){
            $id = auth::user()->landlords->id;
            $properties = Property::withTrashed()->with(['landlords'])->where('landlord_id', $id);
        } elseif(auth::user()->role == 'admin') {
            $properties = Property::withTrashed()->with(['landlords']);
        }

        return datatables()
            ->eloquent($properties)
            ->addColumn('status', function ($properties) {
                if (Auth::user()->role == 'admin') {
                    if ($properties->is_approved == 1)
                        return '<span class="badge rounded-pill bg-info" style="color:white"> Approved </span>';
                    elseif ($properties->is_approved == 0)
                        return '<span class="badge rounded-pill bg-secondary" style="color:white"> Not Approve </span>';
                } elseif (Auth::user()->role == 'landlord') {
                    if ($properties->deleted_at)
                        return '<span class="badge rounded-pill bg-secondary" style="color:white"> Deactivated </span>';
                    elseif ($properties->is_approved == 0)
                        return '<span class="badge rounded-pill bg-secondary" style="color:white"> Not Approve </span>';
                    elseif ($properties->is_taken == 1)
                        return '<span class="badge rounded-pill bg-secondary" style="color:white"> Taken </span>';
                    else
                        return '<span class="badge rounded-pill bg-info" style="color:white"> Available </span>';
                }
            })
            ->addColumn('Approval', function ($row) {
                if (Auth::user()->role == 'admin') {
                    if ($row->is_approved == 1)
                        return '<button href="" class="btn bg-gradient-secondary" disabled>Approved</button>';
                    else
                        return
                            '<form action="' . route('property.approved', $row->id) . '" method="POST">' . csrf_field() . '
                    <input name="_method" type="hidden" >
                    <button class="btn bg-gradient-success float-end" type="submit">Approve</button>
                    </form>';
                } 
            })
            ->addColumn('Deactivate', function ($row) {
                if (Auth::user()->role == 'landlord' or Auth::user()->role == 'admin') {
                    if ($row->deleted_at)
                        return '<a href="' . route('property.restore', $row->id) . '" class="btn bg-gradient-info">Restore</a>';
                    else
                        return
                            '<form action="' . route('property.deactivate', $row->id) . '" method="POST">' . csrf_field() . '
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn bg-gradient-danger" type="submit">Deactivate</button>
                            </form>';
                }
            })
            ->addColumn('Delete', function ($row) {
                if (Auth::user()->role == 'landlord' or Auth::user()->role == 'admin') {
                    if ($row->deleted_at)
                        return '<button href="" class="btn bg-gradient-secondary" disabled>Delete</button>';
                    else
                        return
                            '<form action="' . route('property.destroy', $row->id) . '" method="POST">' . csrf_field() . '
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-outline-danger" type="submit">Delete</button>
                            </form>';
                }
            })
            ->addColumn('Trigger', function ($row) {
                if (Auth::user()->role == 'landlord') {
                    if ($row->deleted_at){
                        return '<button href="" class="btn bg-gradient-secondary" disabled>Available</button>';
                    }
                    elseif($row->is_approved == 1){
                    if ($row->is_taken == 1)
                        return
                            '<form action="' . route('property.available', $row->id) . '" method="POST">' . csrf_field() . '
                            <input name="_method" type="hidden" >
                            <button class="btn bg-gradient-success float-end" type="submit">Available</button>
                            </form>';
                    else
                        return
                            '<form action="' . route('property.taken', $row->id) . '" method="POST">' . csrf_field() . '
                            <input name="_method" type="hidden" >
                            <button class="btn bg-gradient-info float-end" type="submit">Taken</button>
                            </form>';
                    }
                }
            })

            ->addColumn('image', function ($properties) {
                return '<img src="' . asset($properties->imagePath) . '" width="80"height="80" class="rounded" >';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('m/d/Y - h:m A');
            })

//             ->addColumn('Description', function ($row) {
//     return '<button class="btn bg-gradient-primary" data-toggle="modal" data-target="#myModal' . $row->id . '">View</button>
//             <div class="modal fade" id="myModal' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
//               <div class="modal-dialog" role="document">
//                 <div class="modal-content">
//                   <div class="modal-header">
//                     <h5 class="modal-title" id="myModalLabel">Description</h5>
//                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                       <span aria-hidden="true">&times;</span>
//                     </button>
//                   </div>
//                   <div class="modal-body">
//                     <p>' . $row->description . '</p>
//                   </div>
//                 </div>
//               </div>
//             </div>';
// })

            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Property $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Property $model): QueryBuilder
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
            ->setTableId('properties-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
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
            Column::make('area')->title('Area'),
            Column::make('garage')->title('Garage'),
            Column::make('bathroom')->title('Bathroom'),
            Column::make('bedroom')->title('Bedroom'),
            Column::make('rent')->title('Rental fee'),
            Column::make('city')->title('City'),
            Column::make('state')->title('State'),
            Column::make('address')->title('Address'),
            Column::make('description')->title('Description'),
            // Column::make('status'),
            Column::make('status'),
            Column::make('image'),
            Column::make('created_at'),
            Column::computed('Approval')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
            Column::computed('Trigger')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
            Column::computed('Deactivate')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
            Column::computed('Delete')
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
        return 'Properties_' . date('YmdHis');
    }
}