@extends('master')
@section('title','Home')

@section('content')
    <div style="text-align: right; margin-right: 5%;">
        <a href="{{route('posts.create')}}" type="button" class="btn btn-info">Add Post</a>
    </div>
<div class="album py-5 bg-light">
    @if (Session::has('delete_post'))
        <div class="alert alert-success" role="alert">
            {{Session::get('delete_post')}}
        </div>
    @endif
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{$post->image}}" style="object-fit: cover">
                        <div class="card-body">
                            <p class="card-text">{{$post->title}}</p>
                            <small class="text">{{$post->category->title}}</small>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a type="button" class="btn btn-sm btn-outline-secondary btn-info" href="/detail/{{$post->id}}">View</a>

                                    @guest
                                    @else
                                        @if (Auth::user()->id == $post->author_id)

                                            <a type="button" class="btn btn-sm btn-outline-secondary btn-success" href="/edit-post/{{$post->id}}">Edit</a>
                                            <a type="button" class="btn btn-sm btn-outline-secondary btn-danger" href="/delete-post/{{$post->id}}">Delete</a>
                                        @endif
                                    @endguest



                                    {{--                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
