<?php
/** Form
 * @var \App\Models\Ticket\Ticket $ticket
 */
?>
@extends('admin.layouts.admin')

@section('title', __('views.admin.tickets.show.title'))

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th>{{ __('views.admin.ticket.title') }}</th>
                <td>{{ $ticket->title }}</td>
            </tr>

            <tr>
                <th>{{ __('views.admin.ticket.content') }}</th>
                <td>
                    {{$ticket->content}}
                </td>
            </tr>
            <tr>
                <th>{{ __('views.admin.users.show.table_header_3') }}</th>
                <td>
                    {{ $ticket->tags->implode('name', ', ') }}
                </td>
            </tr>
            <tr>
                <th>{{ __('views.admin.users.show.table_header_5') }}</th>
                <td>
                    @if($ticket->status)
                        <span class="label label-success">{{ __('views.admin.ticket.status.1') }}</span>
                    @else
                        <span class="label label-warning">{{ __('views.admin.ticket.status.0') }}</span>
                    @endif</td>
                </td>
            </tr>

            <tr>
                <th>{{__('views.admin.created_by')}} / {{ __('views.admin.users.show.table_header_6') }}</th>
                <td>{{$ticket->creator->name}} / {{ $ticket->created_at }} ({{ $ticket->created_at->diffForHumans() }})</td>
            </tr>

            <tr>
                <th>{{__('views.admin.updated_by')}} / {{ __('views.admin.users.show.table_header_7') }}</th>
                <td>{{$ticket->editor->name}} / {{ $ticket->updated_at }} ({{ $ticket->updated_at->diffForHumans() }})</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection