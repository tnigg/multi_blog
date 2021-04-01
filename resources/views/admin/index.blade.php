@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="jumbotron">
    @if(Auth::user() && Auth::user()->role_id === 1)
        <h1>Admin Dashboard</h1>
    @elseif(Auth::user() && Auth::user()->role_id === 2)
        <h1>Author Dashboard</h1>
    @endif     
    </div>
    @if(Auth::user() && Auth::user()->role_id === 1)    
    <div class="btn-group">
            <form action="{{route('blogs.create')}}">
                <button class="btn btn-primary mr-3">Create Blog</button>                
            </form>
            <form action="{{route('blogs.trash')}}">
                <button class="btn btn-primary mr-3">Show Deleted Blogs</button>
            </form>
            <form action="{{route('admin.users')}}">
                <button class="btn btn-primary mr-3">Show Users</button>
            </form>
            <form action="{{route('categories.create')}}">
                <button class="btn btn-primary mr-3">Create Category</button>
            </form>                       
        </div>
        <a href="{{route('blogs.unreleased')}}"><span class="badge bg-dark text-white">
        Unreleased Blogs: {{$blogs->where('status', 0)->count()}}</span></a>
        @endif



        @if(Auth::user() && Auth::user()->role_id === 2)    
    <div class="btn-group">
            <form action="{{route('blogs.create')}}">
                <button class="btn btn-primary mr-3">Create Blog</button>               
            </form>       
           
            <form action="{{route('categories.create')}}">
                <button class="btn btn-primary mr-3">Create Category</button>
            </form>                       
        </div>
        <a href="{{route('blogs.unreleased')}}"><span class="badge bg-dark text-white">
        Unreleased Blogs: {{$blogs->where('status', 0)->count()}}</span></a>
        @endif
</div>

@endsection