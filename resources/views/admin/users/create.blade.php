@extends('layouts.admin')

@section('page-title')
Create User
@endsection

@section('content')

{!! Form::open(['method' => 'post', 'action' => 'AdminUsersController@store', 'files' => true]) !!}
    @csrf
    <div class="form-group row">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : '').'']) !!}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('email', 'Email: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('email', null, ['class' => 'form-control '.($errors->has('email') ? 'is-invalid' : '').'']) !!}
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('password', 'Password: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-8">
            {!! Form::password('password', ['class' => 'form-control '.($errors->has('password') ? 'is-invalid' : '').'']) !!}
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('file', 'File: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-8">
            {!! Form::file('file', ['class' => 'form-control '.($errors->has('file') ? 'is-invalid' : '').'']) !!}
            @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('role_id', 'Role: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-4">
            {!! Form::select('role_id', $roles, null, ['placeholder' => 'Select role', 'class' => 'form-control '.($errors->has('role_id') ? 'is-invalid' : '').'']) !!}
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('is_active', 'Status: ', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">
            <div class="form-check form-check-inline @error('is_active') is-invalid @enderror">
            {!! Form::radio('is_active', 1, true, ['class' => 'form-check-input '.($errors->has('is_active') ? 'is-invalid' : '').'']) !!}
            {!! Form::label('is_active', 'Active', ['class' => 'form-check-label mr-3']) !!}
            {!! Form::radio('is_active', 0, null, ['class' => 'form-check-input '.($errors->has('is_active') ? 'is-invalid' : '').'']) !!}
            {!! Form::label('is_active', 'Inactive', ['class' => 'form-check-label']) !!}
            </div>
            @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group text-right">
        {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@endsection