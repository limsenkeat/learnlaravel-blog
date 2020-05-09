@extends('layouts.admin')

@section('page-title')
Edit Post
@endsection

@section('content')
<div class="row">
    <div class="col-sm-3">
        <img src="{{ $post->photo ? $post->photo->file : 'https://via.placeholder.com/200?text=No Image'}}" alt="{{$post->name}}">
    </div>
    <div class="col-sm-9">
        {!! Form::open(['method' => 'PUT', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}
        @csrf
        <div class="form-group">
            {!! Form::label('title', 'Title: ') !!}
            {!! Form::text('title', $post->title, ['class' => 'form-control '.($errors->has('title') ? 'is-invalid' : '').'']) !!}
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category: ') !!}
            {!! Form::select('category_id', $categories, $post->category_id, ['placeholder' => 'Select Category', 'class' => 'form-control '.($errors->has('category_id') ? 'is-invalid' : '').'']) !!}
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
            {!! Form::textarea('body', $post->body, ['class' => 'form-control '.($errors->has('body') ? 'is-invalid' : '').'']) !!}
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
            <div class="form-group text-right">
                {!! Form::submit('Update Post', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-12">
        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id] ]) !!}
        {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection