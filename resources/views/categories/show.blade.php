@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
        <h1>Show Posts in category {{ $category->name}}</h1>            
            <div class="btn-group">
                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-warning mr-3">Edit</a>
                <form action="{{route('categories.destroy', $category->id)}}" method="post">
                    {{method_field('delete')}}
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                        
                    {{csrf_field()}}
                </form>
            </div>
        </div>
        
    <div class="container-fluid">
        <div class="col-md-12">
            @foreach($category->blog as $blog)
             <div>
                <h3><a href="{{route('blogs.show', $blog->slug)}}">{{$blog->title}}</a></h3>                
            </div>
            @endforeach
            </div>

            </div>  
    </div>
@endsection
