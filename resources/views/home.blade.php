@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Feed</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($posts as $post)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="post-title"
                                               href="{{route('users.show', ['user' => $post->author])}}">
                                                <img src="{{$post->author->avatar}}"
                                                     alt="{{$post->author->name}}"
                                                     class="rounded-circle"
                                                     width="25px"> {{$post->author->name}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{route('posts.show', ['post' => $post])}}">
                                                <img class="img-fluid mx-auto d-block" src="{{$post->photo}}"
                                                     alt="{{$post->author->name}}">
                                            </a>
                                            <div class="actions">
                                                <div class="like"
                                                     data-href="{{route('posts.like', ['post' => $post])}}">
                                                    {{$post->likeCount}}
                                                    @if($post->liked())
                                                        <i class="fas fa-heart red"></i>
                                                    @else
                                                        <i class="far fa-heart"></i>
                                                    @endif
                                                </div>
                                                <div class="comment">
                                                    <a href="{{route('posts.show', ['post' => $post])}}">{{$post->commentsCount}}
                                                        <i class="far fa-comment"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{--<ul class="list-group list-group-flush">--}}

                        {{--</ul>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            @if(!Auth::guest())
            $('.like').on('click', function () {
                $.ajax({
                    url: $(this).data("href"),
                    type: 'patch',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (data) {
                        window.location.reload(false);
                    }
                });
            });
            @endif
        });
    </script>
@endsection
