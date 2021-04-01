@extends('layouts.app')


@section('content')
@foreach($trashedBlogs as $blog)
    <h2>{{ $blog->title }}</h2>
    <p> {!! $blog->body !!} </p>
    <div class="btn-group">
        <form action="{{route('blogs.restore', $blog->id)}}">
            <button  class="btn btn-success mr-3">Restore</button>
        </form>
        <form action="{{route('blogs.permDelete', $blog->id)}}">
            <button  class="btn btn-danger">Delete permanent</button>
        </form>
    </div>
@endforeach
@endsection