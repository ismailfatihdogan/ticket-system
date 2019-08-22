@extends('admin.layouts.admin')

@section('content')
    <!-- page content -->
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-file-text"></i> {{ __('views.admin.dashboard.count_0') }}</span>
            <div class="count green">{{ $counts['tickets'] }}</div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-file-text"></i> {{ __('views.admin.dashboard.count_1') }}</span>
            <div class="count green">{{ $counts['tags'] }}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i> {{ __('views.admin.dashboard.count_2') }}</span>
            <div class="count green">{{ $counts['users'] }}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-address-card"></i> {{ __('views.admin.dashboard.count_3') }}</span>
            <div>
                <span class="count green">{{  $counts['users'] - $counts['users_unconfirmed'] }}</span>
                <span class="count">/</span>
                <span class="count red">{{ $counts['users_unconfirmed'] }}</span>
            </div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user-times "></i> {{ __('views.admin.dashboard.count_4') }}</span>
            <div>
                <span class="count green">{{  $counts['users'] - $counts['users_inactive'] }}</span>
                <span class="count">/</span>
                <span class="count red">{{ $counts['users_inactive'] }}</span>
            </div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-lock"></i> {{ __('views.admin.dashboard.count_5') }}</span>
            <div>
                <span class="count green">{{  $counts['protected_pages'] }}</span>
            </div>
        </div>
    </div>
    <!-- /top tiles -->

    <!-- Last 10 Tickets -->
    <div class="container">
        <div class="panel-heading">
            <h3 class="text-center">{{__('views.admin.dashboard.last_tickets')}}</h3>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>{{__('views.admin.title')}}</th>
                <th>{{__('views.admin.ticket.content')}}</th>
                <th>{{__('views.admin.ticket.tags')}}</th>
                <th data-column="status">{{__('views.admin.ticket.status')}}</th>
                <th>{{__('views.admin.created_by')}}</th>
                <th>{{__('views.admin.created_at')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($lastTickets as $ticket)
                <tr>
                    <td>{{Html::linkRoute('admin.tickets.show', $ticket->title, $ticket->id)}}</td>
                    <td>{{\Illuminate\Support\Str::limit($ticket->content)}}</td>
                    <td>{{$ticket->tags->implode('name', ', ')}}</td>
                    <td>{{ __('views.admin.ticket.status.'. $ticket->status)}}</td>
                    <td>{{$ticket->creator()->value('name')}}</td>
                    <td>{{$ticket->created_at}}</td>
                    <td>{{\Html::link(route('admin.tickets.show', $ticket->id), '<i class="fa fa-eye"></i>',
                    ['class' => 'btn btn-xs btn-primary', 'title' => __('views.admin.show')], null, false)}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /Last 10 Tickets -->

    <!-- Older than 7 days tickets -->
    <div class="container">
        <div class="panel-heading">
            <h3 class="text-center">{{__('views.admin.dashboard.old_tickets')}}</h3>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>{{__('views.admin.title')}}</th>
                <th>{{__('views.admin.ticket.content')}}</th>
                <th>{{__('views.admin.ticket.tags')}}</th>
                <th data-column="status">{{__('views.admin.ticket.status')}}</th>
                <th>{{__('views.admin.created_by')}}</th>
                <th>{{__('views.admin.created_at')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($oldTickets as $ticket)
                <tr>
                    <td>{{Html::linkRoute('admin.tickets.show', $ticket->title, $ticket->id)}}</td>
                    <td>{{\Illuminate\Support\Str::limit($ticket->content)}}</td>
                    <td>{{$ticket->tags->implode('name', ', ')}}</td>
                    <td>{{ __('views.admin.ticket.status.'. $ticket->status)}}</td>
                    <td>{{$ticket->creator()->value('name')}}</td>
                    <td>{{$ticket->created_at}}</td>
                    <td>{{\Html::link(route('admin.tickets.show', $ticket->id), '<i class="fa fa-eye"></i>',
                    ['class' => 'btn btn-xs btn-primary', 'title' => __('views.admin.show')], null, false)}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /Older than 7 days tickets -->

    <!-- Tags with too many tickets-->
    <div class="container">
        <div class="panel-heading">
            <h3 class="text-center">{{__('views.admin.dashboard.tags_to_many_tickets')}}</h3>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>{{__('views.admin.title')}}</th>
                <th>{{__('views.admin.count')}}</th>
                <th>{{__('views.admin.created_by')}}</th>
                <th>{{__('views.admin.created_at')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tagMostTickets as $tag)
                <tr>
                    <td>{{Html::linkRoute('admin.tags.tickets', $tag->name, $tag->id)}}</td>
                    <td>{{$tag->tickets_count}}</td>
                    <td>{{$tag->creator()->value('name')}}</td>
                    <td>{{$tag->created_at}}</td>
                    <td>{{\Html::link(route('admin.tickets.tag', $tag->id), '<i class="fa fa-eye"></i>',
                    ['class' => 'btn btn-xs btn-primary', 'title' => __('views.admin.show')], null, false)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /Tags with too many tickets -->
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/dashboard.js')) }}
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/dashboard.css')) }}
@endsection
