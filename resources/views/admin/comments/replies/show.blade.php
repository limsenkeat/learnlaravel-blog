@extends('layouts.admin')

@section('external_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}"/>
@endsection

@section('page-title')
Replies
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
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Action</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comment->replies as $k => $reply)
        <tr>
            <th scope="row">{{$reply->id}}</th>
            <td>{{$reply->author}}</td>
            <td>{{$reply->email}}</td>
            <td>{{$reply->body}}</td>
            <td>{{$reply->created_at->diffForHumans()}}</td>
            <td>{{$reply->updated_at->diffForHumans()}}</td>
            <td>
                {!! Form::open(['method' => 'PUT', 'action' => ['CommentRepliesController@update', $reply->id] ]) !!}
                    @csrf
                    <input type="hidden" name="is_active" value="{{$reply->is_active == 0 ? 1 : 0}}">
                    {!! Form::submit($reply->is_active == 0 ? 'Approve' : 'Unapprove', ['class' => 'btn btn-sm '.($reply->is_active == 0 ? 'btn-success' : 'btn-warning').'']) !!}
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id] ]) !!}
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
            "order": [[ 4, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    </script>
@endsection
