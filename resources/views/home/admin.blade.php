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
        <a href="/users/create">
            <button type="button" class="btn btn-primary">Add New User</button>
        </a>

        <div class="mg">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item @if($index===1) disabled @endif"><a class="page-link" href="/home/{{$index-1}}">Previous</a></li>
                    @foreach(range(1,$pages) as $page)
                        <li class="page-item"><a class="page-link" href="/home/{{$page}}">{{$page}}</a></li>
                    @endforeach
                    <li class="page-item @if($index===$pages) disabled @endif"><a class="page-link" href="/home/{{$index+1}}">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
