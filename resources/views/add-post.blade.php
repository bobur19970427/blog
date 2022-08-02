@extends('master')
@section('title','Add Post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Add New Post
                    </div>
                    <div class="card-body">
                        <form action="{{route("posts.addpostsubmit")}}" method="POST" enctype="multipart/form-data">
                            @if (Session::has('post_create'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('post_create')}}
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Post Title">
                            </div>

                            <div class="form-group">
                                <label for="body">Post Body</label>
                                <textarea rows="3" name="body" class="form-control" placeholder="Enter Post Body"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Post Category</label>
                                <select name="category" id="category">
                                    <option value="">-----</option>

                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="image">Example file input</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                            <input type="submit" class="btn btn-success" value="Submit"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
