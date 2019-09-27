@extends('admin.layouts.admin')

@section('title', __('views.admin.tickets.index.title'))

@section('content')
    <div class="row pull-right">
        <a href="{{route('admin.tickets.create')}}" title="{{__('views.admin.tags.create.title')}}"
           class="btn btn-block btn-success">
            <i class="fa fa-file-text" aria-hidden="true"></i>
            {{__('views.admin.tickets.create.title')}}
        </a>
    </div>
    <table class="table table-bordered" id="tickets-table" data-source="{{ $datatableSource }}">
        <thead>
        <tr>
            <th></th>
            <th>{{__('views.admin.title')}}</th>
            <th>{{__('views.admin.ticket.content')}}</th>
            <th>{{__('views.admin.ticket.tags')}}</th>
            <th data-column="status">{{__('views.admin.ticket.status')}}</th>
            <th>{{__('views.admin.created_by')}}</th>
            <th>{{__('views.admin.created_at')}}</th>
            <th>{{__('views.admin.updated_by')}}</th>
            <th>{{__('views.admin.updated_at')}}</th>
            <th></th>
        </tr>
        </thead>
    </table>
    <div class="form-group">
        <div class="col-md-2">
            <select id="select-status" class="form-control select2">
                <option value="">{{__('views.admin.select_choice')}}</option>
                <option value="completed">{{__('views.admin.ticket.completed')}}</option>
                <option value="processing">{{__('views.admin.ticket.processing')}}</option>
            </select>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-sm btn-success" id="save-status">{{__('views.admin.save')}}</button>
        </div>
    </div>
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/datatables.css')) }}
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/datatables.js')) }}
    {{ Html::script(mix('assets/admin/js/tickets/index.js')) }}
@endsection