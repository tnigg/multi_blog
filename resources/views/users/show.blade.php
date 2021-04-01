@extends('layouts.app')

@section('content')

    <div class="container">
    @if($user) 
        <h3>{{ $user->name }}'s recent blogs</h3>
        <p>Role: {{$user->role->name}}</p>
        <hr>
    @endif

        @foreach($user->blogs->where('status', 1) as $blog)               
            <h4><a href="{{route('blogs.show', $blog->slug)}}">{{$blog->title}}</a></h4>created {{$blog->created_at->diffForHumans()}}
        @endforeach
    </div>

@endsection