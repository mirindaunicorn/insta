@extends('admin.layout')

@section('content')
    <div class="row gap-20 masonry pos-r">
        <h4 class="c-grey-900">Users</h4>
        <div class="masonry-sizer col-md-12"></div>
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Users</h6>
                <div class="mT-30">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Bio</th>
                            <th scope="col">Posts</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Registration</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->bio}}</td>
                                <td>{{$user->posts_count}}</td>
                                <td>{{$user->comments_count}}</td>
                                <td>{{$user->created_at->format('d.M.Y H:i:s')}}</td>
                                <td>
                                    <a href="{{route('dashboard.users.edit', ['user' => $user])}}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
@endsection
