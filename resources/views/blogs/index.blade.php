@extends('layouts.app')


@section('content')
<div class="container">
@foreach($blogs as $blog)
    <h2><a href="{{route('blogs.show', $blog->slug)}}">{{ $blog->title }}</a></h2>
    <p>{!! $blog->body !!}</p>

    @if($blog->user)
    <div>Author: <a href="{{ route('users.show', $blog->user->name) }}">{{$blog->user->name}}</a> | Posted: {{ $blog->created_at->diffForHumans()}}</div>
    @endif
    <hr>
@endforeach
</div>

@endsection
