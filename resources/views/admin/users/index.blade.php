@extends('layouts.admin')

@section('page-title')
Users
@endsection

@section('content')

<table class="table table-bordered table-hover">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $k => $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td class="text-center">
                <img src="{{ $user->photo ? $user->photo->file : 'https://via.placeholder.com/30?text=No Image'}}" height="30">
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td class="text-center">
                @if ($user->is_active == "1")
                <span class="badge badge-success">Active</span
                @else
                <span class="badge badge-secondary">Inactive</span
                @endif
            </td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
            <td><a href="{{ route('admin.users.edit', $user->id) }}">Edit</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
