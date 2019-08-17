@extends('layouts.welcome')

@section('content')
    <div class="title m-b-md">
        {{ config('app.name') }}
    </div>
    <div class="m-b-md">
        Sample users:<br/>
        Admin user: admin@test.com / password: admin<br/>
        Demo user: demo@test.com / password: demo
    </div>
@endsection