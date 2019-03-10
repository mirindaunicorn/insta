@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New post</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($errors->all() as $error)
                                                <li class="list-group-item">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="preview" style="display: none">
                                    <h4>Preview</h4>
                                    <img src="" alt="" id="preview" class="img-fluid">
                                </div>
                                <form enctype="multipart/form-data" action="{{route('posts.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control-file" id="photo" name="photo">
                                    </div>
                                    <button type="submit" class="btn btn-success">Create</button>
                                </form>
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
        $(function () {
            $("input:file").change(function (e) {
                if (this.files && this.files[0]) {
                    $('.preview').slideDown();
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#preview').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
