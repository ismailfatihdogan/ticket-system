@extends('admin.layouts.admin')

@section('title', __('views.admin.tickets.edit.title', ['name' => $ticket->title]))

@section('content')
    @include('admin.tickets.form', ['route' => ['admin.tickets.update', $ticket->id], 'method' => 'PUT'])
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/tickets/create-or-update.css')) }}
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/tickets/create-or-update.js')) }}
@endsection