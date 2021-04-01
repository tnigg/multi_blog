@extends('layouts.app')


@section('content')
<div class="container">
@if (session('blog_created'))
    <div class="alert alert-success">
        {{ session('blog_created') }}
    </div>
@endif
<h2>Blog Drafts:</h2>
@foreach($unreleasedBlogs as $blog)
    <h2><a href="{{route('blogs.show', $blog->slug)}}">{{ $blog->title }}</a></h2>
    <p>{!! $blog->body !!}</p>

    <div class="col-md-12 mb-5">
        <div class="btn-group mt-3">
        <form method="post "action="{{route('blogs.edit', $blog->id)}}">        
            <button type="submit" class="btn btn-primary mr-3">Edit</button> 
            {{csrf_field()}}              
        </form>

        <form method="post" action="{{route('blogs.release', $blog->id)}}">        
            <button type="submit" class="btn btn-primary mr-3">Release</button> 
            {{csrf_field()}}       
        </form>

        <form method="get" action="{{route('blogs.deleteDraft', $blog->id)}}">        
            <button type="submit" class="btn btn-danger">Delete</button> 
            {{csrf_field()}}       
        </form>
        
        </div> 
        </div>
        <hr><br>
@endforeach
</div>

@endsection
