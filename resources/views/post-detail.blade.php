@extends('master')
@section('title'," {$post->title} ")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        View Post
                    </div>
                    <div class="card-body">
                        <form>

                            <div class="form-group">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" value="{{$post->title}}" class="form-control" placeholder="Enter Post Title">
                            </div>

                            <div class="form-group">

                                <img src="{{$post->image}}" class="img-fluid" alt="Responsive image" >
                            </div>
                            <div class="form-group">
                                <label for="body">Post Body</label>
                                <textarea rows="3" name="body" class="form-control" placeholder="Enter Post Body">{{$post->content}}</textarea>
                            </div>
                            <p>Category: {{$post->category->title}}</p>
                            {{--        <p>Author: {{$post->author->name}}</p>--}}
                            <p>Created At: {{$post->created_at}}</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
