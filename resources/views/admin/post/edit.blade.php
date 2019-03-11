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
                    <div class="preview" style="margin-bottom: 20px;">
                        <h4>Preview</h4>
                        <img src="{{$post->photo}}" alt="" id="preview" class="img-fluid">
                    </div>
                    <form enctype="multipart/form-data" action="{{route('posts.update', $post)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control-file" id="photo" name="photo">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
