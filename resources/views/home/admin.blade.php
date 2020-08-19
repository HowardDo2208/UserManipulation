@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="col">{{$user->id}}</th>
                        <th scope="col">{{$user->name}}</th>
                        <th scope="col">{{$user->email}}</th>
                        <th scope="col">
                            <a href="/users/{{$user->id}}">
                                <button type="button" class="btn btn-info">Edit</button>
                            </a>
                            <a href="/users/delete/{{$user->id}}" onclick="return confirm('Are you sure about that?')">
                                <button type="button" class="btn btn-danger">Delete</button>
                            </a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="justify-content-end">
            <a href="/users/create">
                <button type="button" class="btn btn-primary">Add New User</button>
            </a>
        </div>
        {{ $users->links() }}

    </div>
@endsection
