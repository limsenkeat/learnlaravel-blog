@extends('layouts.admin')

@section('page-title')
Edit User
@endsection

@section('content')
<div class="row">
    <div class="col-sm-3">
        <img src="{{ $user->image ? asset($user->image) : 'https://via.placeholder.com/200?text=No Image'}}" alt="{{$user->name}}">
    </div>
    <div class="col-sm-9">
        {!! Form::open(['method' => 'PUT', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}
            @csrf
            <div class="form-group row">
                {!! Form::label('name', 'Name: ', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('name', $user->name, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : '').'']) !!}
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('email', $user->email, ['class' => 'form-control '.($errors->has('email') ? 'is-invalid' : '').'']) !!}
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
                {!! Form::label('image', 'Image: ', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-8">
                    {!! Form::file('image', ['class' => 'form-control '.($errors->has('image') ? 'is-invalid' : '').'']) !!}
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('role_id', 'Role: ', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-4">
                    {!! Form::select('role_id', $roles, $user->role_id, ['placeholder' => 'Select role', 'class' => 'form-control '.($errors->has('role_id') ? 'is-invalid' : '').'']) !!}
                    @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('is_active', 'Status: ', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    <div class="form-check form-check-inline @error('is_active') is-invalid @enderror">
                    {!! Form::radio('is_active', 1, $user->is_active == 1 ? true : null, ['class' => 'form-check-input '.($errors->has('is_active') ? 'is-invalid' : '').'']) !!}
                    {!! Form::label('is_active', 'Active', ['class' => 'form-check-label mr-3']) !!}
                    {!! Form::radio('is_active', 0, $user->is_active == 0 ? true : null, ['class' => 'form-check-input '.($errors->has('is_active') ? 'is-invalid' : '').'']) !!}
                    {!! Form::label('is_active', 'Inactive', ['class' => 'form-check-label']) !!}
                    </div>
                    @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group text-right">
                {!! Form::submit('Update User', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-12">
        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id] ]) !!}
        {!! Form::submit('Delete User', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection