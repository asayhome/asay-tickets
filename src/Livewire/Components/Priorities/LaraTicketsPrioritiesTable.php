<?php

namespace AsayDev\LaraTickets\Livewire\Components\Priorities;

use AsayDev\LaraTickets\Livewire\BaseLivewire;
use AsayDev\LaraTickets\Models\Agent;
use AsayDev\LaraTickets\Models\Priority;
use AsayDev\LaraTickets\Models\Setting;
use AsayDev\LaraTickets\Models\Status;
use AsayDev\LaraTickets\Models\Ticket;
use AsayDev\LaraTickets\Traits\SlimNotifierJs;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LaraTicketsPrioritiesTable extends BaseLivewire
{

    public $dashboardData;

    public function mount($dashboardData)
    {
        $this->dashboardData = $dashboardData;
    }

    public function query(): Builder
    {
        return Priority::orderBy('id', 'asc');
    }
    /**
     * @inheritDoc
     */
    public function columns(): array
    {

        $columns = [
            Column::make(trans('laratickets::admin.table-id'), 'id')
                ->sortable()
                ->searchable(),
            Column::make(trans('laratickets::admin.table-name'))
                ->format(function ($value, $column, $row) {
                    return '<a class="btn btn-link" wire:click="viewPriority(' . $row->id . ')" >' . $row->name . '</a>';
                })
                ->asHtml(),
            Column::make(trans('laratickets::admin.category-create-color'), 'color')
                ->sortable(),
            Column::make(trans('laratickets::admin.table-action'))
                ->format(function ($value, $column, $row) {
                    return '<a class="btn btn-danger" wire:click="delete(' . $row->id . ')" >' . trans('laratickets::admin.btn-remove') . '</a>';
                })
                ->asHtml(),
        ];


        return $columns;
    }


    public function delete($id)
    {
        try {
            Priority::where('id', $id)->delete();
            $msg = SlimNotifierJs::prepereNotifyData(SlimNotifierJs::$success, $this->dashboardData['active_nav_title'], trans('laratickets::lang.table-deleted-success'));
            $this->emit('laratickets-flash-message', $msg);
        } catch (\Exception $e) {
            //
        }
    }

    public function viewPriority($id)
    {
        $this->dashboardData['form'] = ['name' => 'priorities', 'action' => 'edit', 'id' => $id];
        $this->dashboardData['active_nav_title'] = trans('laratickets::admin.priority-index-title') . ': ' . trans('laratickets::lang.table-edit-title');
        $this->emit('activeNvTab', $this->dashboardData);
    }
}
