<div class="card">
    <h5 class="card-header d-flex justify-content-between align-items-baseline flex-wrap">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{$dashboardData['active_nav_title']}}
            </h4>
        </div>
        <!--col-->
        <div class="col-sm-7 pull-right">
            <div class="btn-toolbar float-right" role="toolbar">
                <a wire:click="openForm('new_priority')" class="btn btn-success ml-1" data-toggle="tooltip"
                    title="{{trans('laratickets::btn-create-new-priority')}}"><i class="bi bi-plus-circle"></i></a>
            </div>
        </div>
        <!--col-->
    </h5>
    <div class="card-body">
        @if($dashboardData['form']['name']=='priorities')
        @livewire('lara-tickets-priorities-form',['dashboardData'=>$dashboardData])
        @endif
        @if($dashboardData['form']['name']=='')
        @livewire('lara-tickets-priorities-table',['dashboardData'=>$dashboardData])
        @endif
    </div>
</div>