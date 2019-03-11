@extends('admin.layout')

@section('content')
    <div class="row gap-20 masonry pos-r">
        <h4 class="c-grey-900">Edit {{$user->name}}</h4>
        <div class="masonry-sizer col-md-12"></div>
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Edit {{$user->name}}</h6>
                <div class="mT-30">
                    <form enctype="multipart/form-data" method="post" action="{{route('users.update', $user)}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="{{ $user->name }}" class="form-control" name="name"
                                   id="username" aria-describedby="usernameHelp" placeholder="Username">
                            <small id="usernameHelp" class="form-text text-muted">Lower case.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                   aria-describedby="emailHelp" value="{{ $user->email }}"
                                   placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                anyone else.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                   id="confirm-password" placeholder="Confirm password">

                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control-file" id="avatar" name="avatar">
                        </div>
                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3">{{$user->bio}}</textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
