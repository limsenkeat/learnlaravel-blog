@extends('layouts.admin')

@section('page-title')
Create Category
@endsection

@section('content')

{!! Form::open(['method' => 'post', 'action' => 'AdminCategoriesController@store']) !!}
    @csrf
    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : '').'']) !!}
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group text-right">
        {!! Form::submit('Create Category', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@endsection