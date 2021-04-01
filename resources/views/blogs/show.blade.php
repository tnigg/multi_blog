@extends('layouts.app')
@include('partials.meta_dynamic')

@section('content')
<div class="container-fluid">
    <div class="jumbotron"> 

        <div class="col-md-12">
            @if($blog->featured_image)
                <img class="img-responsive featured_image" src="/images/featured_image/{{$blog->featured_image ? $blog->featured_image : ''}}"
                 alt="{{str_limit($blog->title, 50)}}">                 
            @endif
        </div>
        <div class="col-md-12">
            <h1>{{$blog->title}}</h1>
            
        </div>
        <div class="col-md-12">
        <div class="btn-group mt-3">
        <form method="post "action="{{route('blogs.edit', $blog->id)}}">        
            <button type="submit" class="btn btn-primary mr-3">Edit</button> 
            {{csrf_field()}}              
        </form>

        <form method="post" action="{{route('blogs.unrelease', $blog->id)}}">        
            <button type="submit" class="btn btn-primary mr-3">Unrelease</button> 
            {{csrf_field()}}       
        </form>

        <form method="post" action="{{route('blogs.delete', $blog->id)}}">        
            <button type="submit" class="btn btn-danger">Delete</button> 
            {{csrf_field()}}       
        </form>
        
        </div> 
        </div>
        </div>
       
    </div>
    <div class="col-md-12">
        <p>{!!$blog->body!!}</p>
       <hr>
       <strong>Categories:</strong>
       @foreach($blog->category as $category)
        <span><a href="{{route('categories.show', $category->slug)}}">{{$category->name}}</a></span>        
       @endforeach
       <hr>
       @if($blog->user)
    <div>Author: <a href="{{ route('users.show', $blog->user->name) }}">{{$blog->user->name}}</a> | Posted: {{ $blog->created_at->diffForHumans()}}</div>
    @endif
    </div>

    <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    
   
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://watwoot.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>
@endsection