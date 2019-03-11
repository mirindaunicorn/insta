@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($users as $user)
                                <li class="list-group-item">
                                    <a href="{{route('users.by.name', ['name' => $user->name])}}">
                                        <img src="{{$user->avatar}}"
                                             alt="{{$user->name}}"
                                             class="rounded-circle"
                                             width="25px" height="25px"> {{$user->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
