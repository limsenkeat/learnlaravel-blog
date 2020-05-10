@extends('layouts.admin')

@section('external_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}"/>
@endsection

@section('page-title')
Categories
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

<table class="table table-bordered table-hover" id="categoryTable">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $k => $category)
        <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->name}}</td>
            <td>{{$category->created_at->diffForHumans()}}</td>
            <td>{{$category->updated_at->diffForHumans()}}</td>
            <td><a href="{{ route('admin.categories.edit', $category->id) }}">Edit</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('external_js') 
    <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js') }} "></script>
    <script>
        $('#categoryTable').DataTable({
            "order": [[ 2, "desc" ]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    </script>
@endsection
