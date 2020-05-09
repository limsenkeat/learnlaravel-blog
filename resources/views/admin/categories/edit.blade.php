@extends('layouts.admin')

@section('page-title')
Edit Category
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        {!! Form::open(['method' => 'PUT', 'action' => ['AdminCategoriesController@update', $category->id], 'files' => true]) !!}
        @csrf
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', $category->name, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : '').'']) !!}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group text-right">
            {!! Form::submit('Update Category', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <div class="col-12">
        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id] ]) !!}
        {!! Form::submit('Delete Category', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection