@extends('layouts.admin')

@section('external_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}"/>
@endsection

@section('page-title')
Posts
@endsection

@section('content')

@if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<table class="table table-bordered table-hover" id="postTable">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Photo</th>
            <th scope="col">Category</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">User</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $k => $post)
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td class="text-center">
                <img src="{{ Storage::exists($post->image) ? asset($post->image) : 'https://via.placeholder.com/30?text=No Image'}}" height="30">
            </td>
            <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
            <td>
            @can('view', $post)
                <a href="{{ route('admin.posts.edit', $post->id) }}">Edit
            @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('external_js') 
    <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js') }} "></script>
    <script>
        $('#postTable').DataTable({
            "order": [[ 6, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    </script>
@endsection
