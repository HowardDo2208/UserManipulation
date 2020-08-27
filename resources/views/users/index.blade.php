@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/users/index" method="GET">
            <div class="form-group row">
                <label for="name-search" class="col-md-0 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                    <input id="name-search" type="text" class="form-control" name="name"
                    value="{{isset($nameBox) ? $nameBox : ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email-search" class="col-md-0 col-form-label text-md-right">Email</label>
                <div class="col-md-6">
                    <input id="email-search" type="text" class="form-control" name="email"
                    value="{{isset($emailBox) ? $emailBox : ''}}">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <a href="/users/export?email={{isset($emailBox) ? $emailBox : ''}}&name={{isset($nameBox) ? $nameBox : ''}}">
            <button class="btn btn-primary">Export</button>
        </a>
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
        {{ $users->withQueryString()->links() }}

    </div>
@endsection
