@extends('layouts.home')


@section('external_css')
<link href="{{asset('css/blog-post.css')}}" rel="stylesheet"> 
@endsection

@section('content')

<!-- Title -->
<h1 class="mt-4">{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
    by
    <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p>Posted on {{$post->created_at->diffForHumans()}}</p>

<hr>

<!-- Preview Image -->
<img class="img-fluid rounded" src="{{ Storage::exists($post->image) ? asset($post->image) : 'http://placehold.it/750x300' }}" alt="{{$post->title}}">

<hr>

<!-- Post Content -->
{{$post->body}}

<hr>

<!-- Comments Form -->
<div class="card my-4">
    <h5 class="card-header">Leave a Comment:</h5>
    <div class="card-body">
        @if(!Auth::check())
        Please <a href="{{route('login')}}">login</a> to add comment.
        @else
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}
            @csrf
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="form-group">
                {!! Form::textarea('body', null, ['class' => 'form-control '.($errors->has('body') ? 'is-invalid' : '').'', 'rows' => 3]) !!}
            </div>
            @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        @endif
    </div>
</div>

@if (count($post->comments()->whereIsActive(1)->get()) > 0)
@foreach ($post->comments()->whereIsActive(1)->get() as $comment)
<!-- Single Comment -->
<div class="media mb-4">
    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
    <div class="media-body">
        <h5 class="mt-0">{{$comment->author}} <small class="text-muted">{{$comment->created_at->diffForHumans()}}</small></h5>
        {{$comment->body}}

        @if (count($comment->replies()->whereIsActive(1)->get()) > 0)
        @foreach ($comment->replies()->whereIsActive(1)->get() as $reply)
        <div class="media mt-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
                <h5 class="mt-0">{{$reply->author}} <small class="text-muted">{{$reply->created_at->diffForHumans()}}</small></h5>
                {{$reply->body}}
            </div>
        </div>
        @endforeach
        @endif

        <div class="media mt-4">
            <div class="media-body">
                @if(Auth::check())
                @if(session('status_'.$comment->id))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('status_'.$comment->id)}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@store']) !!}
                    @csrf
                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    <div class="form-group">
                        {!! Form::textarea('body', null, ['class' => 'form-control '.($errors->has('body') ? 'is-invalid' : '').'', 'rows' => 1]) !!}
                    </div>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    {!! Form::submit('Reply', ['class' => 'btn btn-primary float-right']) !!}
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection
