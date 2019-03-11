@extends('admin.layout')

@section('content')
    <div class="row gap-20 masonry pos-r">
        <h4 class="c-grey-900">Posts</h4>
        <div class="masonry-sizer col-md-12"></div>
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Posts</h6>
                <div class="mT-30">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Author</th>
                            <th scope="col" style="width: 400px;">Photo</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Likes</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{$post->id}}</th>
                                <td>{{$post->author->name}}</td>
                                <td><img src="{{$post->photo}}" alt="{{$post->author->name}}" class="img-thumbnail">
                                </td>
                                <td>{{$post->comments_count}}</td>
                                <td>{{$post->likeCount}}</td>
                                <td>{{$post->created_at->format('d.M.Y H:i:s')}}</td>
                                <td>
                                    <form style="display: inline;" method="POST"
                                          action="{{route('posts.destroy', ['post' => $post])}}?back=true"
                                          onSubmit="if(!confirm('Are you sure?')){return false;}"
                                    >
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{route('dashboard.posts.edit', ['post' => $post])}}"
                                       class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
@endsection
