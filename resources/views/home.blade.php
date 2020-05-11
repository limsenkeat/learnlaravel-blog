@extends('layouts.home')

@section('external_css')
<link href="{{asset('css/blog-home.css')}}" rel="stylesheet"> 
@endsection

@section('content')

<h1 class="my-4">Laravel Blog
    <small>For study</small>
</h1>

@foreach ($posts as $post)
 <!-- Blog Post -->
<div class="card mb-4">
    <img class="card-img-top" src="{{ Storage::exists($post->image) ? asset($post->image) : 'http://placehold.it/750x300' }}" alt="Card image cap">
    <div class="card-body">
        <h2 class="card-title">{{$post->title}}</h2>
        <p class="card-text">{{ Str::limit($post->body, 200, '...') }}</p>
        <a href="{{route('post', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
        Posted on {{$post->created_at->diffForHumans()}}
        <a href="#">{{$post->user->name}}</a>
    </div>
</div>   
@endforeach

{{$posts->links()}}

<!-- Pagination -->
{{-- <ul class="pagination justify-content-center mb-4">
    <li class="page-item">
        <a class="page-link" href="#">&larr; Older</a>
    </li>
    <li class="page-item disabled">
        <a class="page-link" href="#">Newer &rarr;</a>
    </li>
</ul> --}}

@endsection
