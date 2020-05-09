@extends('layouts.admin')

@section('page-title')
Create Post
@endsection

@section('content')

{!! Form::open(['method' => 'post', 'action' => 'AdminPostsController@store', 'files' => true]) !!}
    @csrf
    <div class="form-group">
        {!! Form::label('title', 'Title: ') !!}
        {!! Form::text('title', null, ['class' => 'form-control '.($errors->has('title') ? 'is-invalid' : '').'']) !!}
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('category_id', 'Category: ') !!}
        {!! Form::select('category_id', $categories, null, ['placeholder' => 'Select Category', 'class' => 'form-control '.($errors->has('category_id') ? 'is-invalid' : '').'']) !!}
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('photo', 'File: ') !!}
        {!! Form::file('photo', ['class' => 'form-control '.($errors->has('file') ? 'is-invalid' : '').'']) !!}
        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('body', 'Content: ') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control '.($errors->has('body') ? 'is-invalid' : '').'']) !!}
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group text-right">
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@endsection