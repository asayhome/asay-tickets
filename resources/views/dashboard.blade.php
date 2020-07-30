
<div class="container">

    @include('asaydev-lara-tickets::layouts.assets')

    @include('asaydev-lara-tickets::layouts.errors')

    <div class="card mb-3">
        <div class="card-body">
            @include('asaydev-lara-tickets::layouts.nav')
        </div>
    </div>
    @if(View::hasSection('ticketit_content'))
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-baseline flex-wrap">
                @if(View::hasSection('page_title'))
                    <span>@yield('page_title')</span>
                @else
                    <span>@yield('page')</span>
                @endif

                @yield('ticketit_header')
            </h5>
            <div class="card-body @yield('ticketit_content_parent_class')">
                @yield('ticketit_content')
            </div>
        </div>
    @endif
    @yield('ticketit_extra_content')
</div>
