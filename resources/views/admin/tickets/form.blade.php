<?php
/** Form
 * @var \App\Models\Ticket\Ticket $ticket
 * @var array $ticketTags
 * @var \App\Models\Ticket\Tag[] $tags
 * @var array|string $route
 * @var string $method
 */
?>

{{ Form::open(['route' => $route, 'method' => $method, 'class' => 'form-horizontal form-label-left']) }}

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="form-group">
        {{Form::label('title', __('views.admin.title'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}

        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::text('title', $ticket->title, ['class' => 'form-control'])}}
            @if($errors->has('title'))
                <ul class="parsley-errors-list filled">
                    @foreach($errors->get('title') as $error)
                        <li class="parsley-required">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="form-group">
        {{Form::label('content', __('views.admin.ticket.content'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}

        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::textarea('content', $ticket->title, ['class' => 'form-control'])}}
            @if($errors->has('content'))
                <ul class="parsley-errors-list filled">
                    @foreach($errors->get('content') as $error)
                        <li class="parsley-required">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="form-group">
        {{Form::label('tags', __('views.admin.ticket.tags'), ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'])}}

        <div class="col-md-6 col-sm-6 col-xs-12">
            {{Form::select('tags[]', $tags, $ticketTags ?? [], ['multiple' => 'multiple', 'class' => 'form-control select2'])}}
            @if($errors->has('tags'))
                <ul class="parsley-errors-list filled">
                    @foreach($errors->get('tags') as $error)
                        <li class="parsley-required">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    @if($route !== 'admin.tickets.store')
    <div class="form-group">
        <div class="col-md-offset-3">
            <label>
                {{Form::checkbox('status', 1, $ticket->status, ['class' => 'js-switch'])}}
                {{__('views.admin.completed')}}
            </label>
        </div>
    </div>
    @endif
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            {{Html::link(URL::previous(), __('views.admin.cancel'), ['class' => 'btn btn-primary'])}}

            {{Form::submit(__('views.admin.save'), ['class' => 'btn btn-success'])}}
        </div>
    </div>
</div>
{{Form::close()}}