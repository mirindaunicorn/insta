@extends('admin.layout')

@section('content')
    <div class="row gap-20 masonry pos-r">
        <h4 class="c-grey-900">Edit comment</h4>
        <div class="masonry-sizer col-md-12"></div>
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">Edit comment</h6>
                <div class="mT-30">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form enctype="multipart/form-data" method="post" action="{{route('comments.update', $comment)}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="body">Text</label>
                            <textarea class="form-control" id="body" name="body" rows="3">{{$comment->body}}</textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
