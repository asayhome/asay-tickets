<?php

namespace AsayDev\LaraTickets\Livewire\Components\Agents;

use AsayDev\LaraTickets\Livewire\BaseLivewire;
use AsayDev\LaraTickets\Models\Agent;
use AsayDev\LaraTickets\Traits\SlimNotifierJs;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

use Rappasoft\LaravelLivewireTables\Views\Column;

class LaraTicketsAgentsTable extends BaseLivewire
{
    public $dashboardData;


    public function mount($dashboardData)
    {
        $this->dashboardData = $dashboardData;
    }

    public function query(): Builder
    {
        return Agent::where('laratickets_agent', '1')->orderBy('id', 'asc');
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
            Column::make(trans('laratickets::admin.table-name'), 'name')->sortable(),
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
            Agent::where('id', $id)->update(['laratickets_agent' => 0]);
            $msg = SlimNotifierJs::prepereNotifyData(SlimNotifierJs::$success, $this->dashboardData['active_nav_title'], trans('laratickets::lang.table-deleted-success'));
            $this->emit('laratickets-flash-message', $msg);
        } catch (\Exception $e) {
            //
        }
    }
}
