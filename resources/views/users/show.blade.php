@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    {{--<div class="card-header">Users</div>--}}

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="ratio img-responsive img-circle"
                                     style="background-image: url({{$user->avatar}});"></div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>{{$user->name}}
                                            @if(Auth::user() !== null && Auth::user()->id === $user->id)
                                                <a href="{{ route('users.edit', ['user' => $user]) }}"
                                                   class="btn btn-outline-secondary btn-sm">Edit profile</a>
                                            @else
                                                <form style="display: inline;"
                                                      action="{{route('users.subscribe', ['user' => $user])}}"
                                                      method="POST">
                                                    @method('patch')
                                                    @csrf
                                                    @if(!Auth::user()->hasSubscribed($user))
                                                        <button class="btn btn-primary btn-sm">Subscribe</button>
                                                    @else
                                                        <button class="btn btn-outline-dark btn-sm">Unsubscribe</button>
                                                    @endif
                                                </form>

                                            @endif
                                        </h3>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="list-inline stats">
                                            <li class="list-inline-item"><strong>{{$user->postsCount}}</strong>
                                                publications
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{route('users.subscribers', ['user' => $user])}}">
                                                    <strong>{{$user->subscribers()->count()}}</strong> subscribers
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{route('users.subscriptions', ['user' => $user])}}">Subscribed:
                                                    <strong>{{$user->subscriptions()->count()}}</strong>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        {!! nl2br(e($user->bio)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row feed">
                            <div class="col-md-12">
                                <div class="container">
                                    <div class="row imagetiles">
                                        @foreach($posts as $post)
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="padding-top: 30px">
                                                <div class="square"
                                                     style="background-image: url('{{$post->photo}}')"
                                                     data-href="{{route('posts.show', ['post' => $post])}}"
                                                >
                                                    <div class="items">
                                                        <span class="item">
                                                            <i class="fas fa-comment"
                                                               style=""></i> {{$post->commentsCount }}
                                                        </span>
                                                        <span class="item">
                                                            @if($post->liked())
                                                                <i class="fas fa-heart red"></i>
                                                            @else
                                                                <i class="far fa-heart"></i>
                                                            @endif {{$post->likeCount}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-md-12">
                                            {{$posts->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $(".square").on('click', function (event) {
                window.location.href = $(this).data("href");
                event.preventDefault();
            });

            $('.like-action').on('click', function () {
                $.ajax({
                    url: $(this).data("href"),
                    type: 'PATCH',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data)
                    }
                });
            });
        });
    </script>
@endsection
