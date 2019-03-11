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
                            <th scope="col">Post</th>
                            <th scope="col">Body</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <th scope="row">{{$comment->id}}</th>
                                <td>{{$comment->author->name}}</td>
                                <td>{{$comment->post->id}}</td>
                                <td>{{$comment->body}}</td>
                                <td>{{$comment->created_at->format('d.M.Y H:i:s')}}</td>
                                <td>
                                    <form style="display: inline;" method="POST"
                                          action="{{route('comments.destroy', ['comment' => $comment])}}?back=true"
                                          onSubmit="if(!confirm('Are you sure?')){return false;}"
                                    >
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{route('dashboard.comments.edit', ['comment' => $comment])}}"
                                       class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
@endsection
