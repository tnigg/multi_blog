@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Update Blog</h1>
        </div>

        <div class="col-md-12">
            <form action="{{route('blogs.update', $blog->id)}}" method="post"  enctype="multipart/form-data">
            {{method_field('PATCH')}};
                <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$blog->title}}">
                </div>

                <div class="form-group">
                <label for="body">Text</label>
                <textarea type="text" name="body" id="body" class="form-control">{{$blog->body}}</textarea>
                </div>

                <div class="form-group form-check form-check-inline">                    
                    @foreach($categories as $category)
                        <input type="checkbox" value="{{$category->id}}" name="category_id[]" class="form-check-input mr-1 ml-1">
                        <label class="form-check-label">{{$category->name}}</label>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control">
                </div>

                <div>
                <button class="btn btn-primary" type="submit">Edit blog</button>
                {{csrf_field()}}
                </div>
            </form>
        </div>
    </div>

@endsection