<?php

namespace App\DataTables;

use App\Models\Invitations;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\ExportMeetingAttendance;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ExportMeetingAttendanceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->eloquent($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExportMeetingAttendance $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExportMeetingAttendance $model): QueryBuilder
    {
       // return $model->newQuery();
       $data = Invitations::select();
       return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
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
            Column::make('user_id'),
            Column::make('meeting_id'),
            Column::make('meeting_id'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ExportMeetingAttendance_' . date('YmdHis');
    }
}
