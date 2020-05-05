@extends('layouts.admin')

@section('page-title')
Create User
@endsection

@section('content')

{!! Form::open(['method' => 'post', 'action' => 'AdminUsersController@store']) !!}
    @csrf
    <div class="form-group row">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('email', 'Email: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('role', 'Role: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-4">
            {!! Form::select('status', [ '' => 'Select role'] + $roles, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('status', 'Status: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            <div class="form-check form-check-inline">
            {!! Form::radio('role', 1, true, ['class' => 'form-check-input']) !!}
            {!! Form::label('role', 'Active', ['class' => 'form-check-label mr-3']) !!}
            {!! Form::radio('role', 0, null, ['class' => 'form-check-input']) !!}
            {!! Form::label('role', 'Inactive', ['class' => 'form-check-label']) !!}
            </div>
        </div>
    </div>
    <div class="form-group text-right">
        {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@endsection