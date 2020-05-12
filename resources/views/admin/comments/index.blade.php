@extends('layouts.admin')

@section('external_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}"/>
@endsection

@section('page-title')
Comments
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

<table class="table table-bordered table-hover" id="commentTable">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Author</th>
            <th scope="col">email</th>
            <th scope="col">Comment</th>
            <th scope="col">Post</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">View Replies</th>
            <th scope="col">Action</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $k => $comment)
        <tr>
            <th scope="row">{{$comment->id}}</th>
            <td>{{$comment->author}}</td>
            <td>{{$comment->email}}</td>
            <td>{{$comment->body}}</td>
            <td><a href="{{route('post', ['id' => $comment->post_id])}}" target="_blank" rel="noopener noreferrer">View Post</a></td>
            <td>{{$comment->created_at->diffForHumans()}}</td>
            <td>{{$comment->updated_at->diffForHumans()}}</td>
            <td><a href="{{route('admin.replies.show', $comment->id)}}">Replies</a></td>
            <td>
                {!! Form::open(['method' => 'PUT', 'action' => ['PostCommentsController@update', $comment->id] ]) !!}
                    @csrf
                    <input type="hidden" name="is_active" value="{{$comment->is_active == 0 ? 1 : 0}}">
                    {!! Form::submit($comment->is_active == 0 ? 'Approve' : 'Unapprove', ['class' => 'btn btn-sm '.($comment->is_active == 0 ? 'btn-success' : 'btn-warning').'']) !!}
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id] ]) !!}
                    @csrf
                    {!! Form::submit('X', ['class' => 'btn btn-sm btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('external_js') 
    <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js') }} "></script>
    <script>
        $('#commentTable').DataTable({
            "order": [[ 5, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    </script>
@endsection
