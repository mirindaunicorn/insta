@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$post->created_at->format('d M Y H:i')}} <a
                            href="{{route('users.show', ['user' => $post->author])}}">{{'@'.$post->author->name}}</a>
                        @if(!Auth::guest() && Auth::user()->isAdmin() || Auth::user()->id === $post->author->id)
                            <form style="display: inline;" method="POST" class="float-right"
                                  action="{{route('posts.destroy', ['post' => $post])}}"
                                  onSubmit="if(!confirm('Are you sure?')){return false;}"
                            >
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form> @endif
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{$post->photo}}" class="img-fluid" alt="Likes: 99">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                @if(!Auth::guest())
                                    <div class="actions">
                                        <div class="like"
                                             data-href="{{route('posts.like', ['post' => $post])}}">
                                            @if($post->liked())
                                                <i class="fas fa-heart red"></i>
                                            @else
                                                <i class="far fa-heart"></i>
                                            @endif
                                        </div>
                                        <div class="comment">
                                            <i class="far fa-comment"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9 likes">
                                Liked: <strong>{{$post->likeCount}}</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @foreach($post->comments as $comment)
                                    <div class="post-comment" id="comment-{{$comment->id}}">
                                        <a href="{{route('users.show', ['user' => $comment->author])}}"><strong>{{$comment->author->name}}</strong></a> {{$comment->body}}
                                        @if(!Auth::guest() && Auth::user()->isAdmin() || (Auth::user()->id === $post->author->id || Auth::user()->id === $comment->author->id))
                                            <form style="display: inline;" method="POST" class="float-right"
                                                  action="{{route('comments.destroy', ['comment' => $comment])}}"
                                                  onSubmit="if(!confirm('Are you sure?')){return false;}"
                                            >
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger btn-sm"
                                                        style="padding: 0.01rem .2rem;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form> @endif
                                    </div>
                                @endforeach
                                @if(!Auth::guest())
                                    <form action="{{route('comments.store')}}" method="POST" id="add-comment"
                                          style="padding-top: 20px; display: none">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="body" placeholder="Comment"
                                                   aria-label="Comment" aria-describedby="button-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit"
                                                        id="button-addon2">
                                                    <i class="far fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
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
            $('.comment').on('click', function () {
                $('#add-comment').slideToggle();
            });
            @endif
        });
    </script>
@endsection
