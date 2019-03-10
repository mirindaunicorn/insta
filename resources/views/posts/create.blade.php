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
                                <form action="{{route('posts.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control-file" id="photo" name="photo">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
