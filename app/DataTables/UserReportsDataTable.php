<?php

namespace App\DataTables;

use App\Models\UserReport;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class UserReportsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query)) 
            ->filter(function ($query) {
                if(Auth::user()?->hasRole('Administrator')){
                    if (request()->has('user_id')) {
                        $query->where('user_id', '=', request('user_id') );
                    }
                }else{
                    $query->where('user_id', '=', Auth::user() );
                }
            })
            ->editColumn('user', function(UserReport $userReport) {
                return $userReport->user?->name;
            })
            ->editColumn('report_date', function(UserReport $userReport) {
                return $userReport->report_date;
            })
            ->editColumn('start_time', function(UserReport $userReport) {
                return $userReport->log_in;
            })
            ->editColumn('end_time', function(UserReport $userReport) {
                return $userReport->log_out;
            })
            ->editColumn('break_total', function(UserReport $userReport) {
                return $userReport->break_total;
            })
            ->editColumn('total_time', function(UserReport $userReport) {
                return $userReport->total_time;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(UserReport $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('userreports-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->searching(false)
                    ->info(false)
                    ->buttons([
                       // Button::make('excel'),
                       // Button::make('csv'),
                       // Button::make('pdf'),
                       // Button::make('print'),
                       // Button::make('reset'),
                       // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        if(Auth::user()?->hasRole('Administrator')){
            $coloumns[] = Column::make('user');
        }
        $coloumns[] = Column::make('report_date');
        $coloumns[] = Column::make('start_time');
        $coloumns[] = Column::make('end_time');
        $coloumns[] = Column::make('break_total');
        $coloumns[] = Column::make('total_time');
        return $coloumns;    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UserReports_' . date('YmdHis');
    }
}
