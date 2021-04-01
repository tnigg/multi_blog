@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Create a new Category</h1>
        </div>

        <div class="col-md-12">
            <form action="{{route('categories.store')}}" method="post">
                <div class="form-group">
                <label for="title">Category Name</label>
                <input type="text" name="name" id="name" class="form-control">
                </div>            

                <button class="btn btn-primary" type="submit">Create new category</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>

@endsection