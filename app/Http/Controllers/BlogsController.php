<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function __construct() {
        $this->middleware('author', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('admin', ['only' => ['delete', 'trash', 'restore', 'permDelete', 'release', 'unrelease', 'unreleased']]);       

    }

    public function index() {
      
        $blogs = Blog::where('status', 1)->latest()->get();      
        
        return view('blogs.index', compact('blogs'));
    }

    public function create() {
        $categories = Category::latest()->get();

        return view('blogs.create', compact('categories'));    
    }

    public function store(Request $request) {
        // Validate
        $rules = [
            'title' => ['required', 'min:20', 'max:160'],
            'body' => ['required', 'min:200']
        ];

        $this->validate($request, $rules);

        $input = $request->all();
        // Meta Stuff
        $input['slug'] = Str::slug($request->title, '-');
        $input['meta_title'] = Str::limit($request->title, 55);
        $input['meta_description'] = Str::limit($request->body, 155);
        
        // Image Upload
        if($file = $request->file('featured_image')) {
            
            $name = uniqid() . $file->getClientOriginalName();
            $file->move('images/featured_image/', $name);
            $input['featured_image'] = $name;
        }

        // Save the blog
        
        $blogByUser = $request->user()->blogs()->create($input);

        //sync with categories
        if($request->category_id) {
            $blogByUser->category()->sync($request->category_id);
        }
                
        return redirect('/blogs/unreleased')->with('blog_created', 'Blog draft has been created');
    }

    public function show($slug) {
        //$blog = Blog::findOrFail($slug);       
        $blog = Blog::whereSlug($slug)->first(); 
        return view('blogs.show', compact('blog'));
    }

    public function edit($id) {
        $categories = Category::latest()->get();
        $blog = Blog::findOrFail($id); 
        return view('blogs.edit', ['blog' => $blog, 'categories' => $categories]);
    }

    public function update(Request $request, $id) {
        $blog = Blog::findOrFail($id);
        
        $input = $request->all(); 
               
        //Update featured Image
        if($file = $request->file('featured_image')) {            
            $name = uniqid() . $file->getClientOriginalName();            
            $file->move('images/featured_image/', $name);
            $input['featured_image'] = $name;
        }
        
        //Update Blog and sync with categories
        $blog->update($input);
        if($request->category_id) {
            $blog->category()->sync($request->category_id);
        }
        return redirect('/');
    }

    public function delete($id) {
        $blog = Blog::findOrFail($id);
        $blog = $blog->delete();
        return redirect('/');
    }

    public function trash() {       
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('blogs.trash', compact('trashedBlogs'));
    }

    public function restore($id) {
        $restoredBlog = Blog::onlyTrashed()->findOrFail($id);
        $restoredBlog->restore();
        return redirect('/');
    }

    public function permDelete($id) {
        $deleteBlog = Blog::onlyTrashed()->findOrFail($id);
        $deleteBlog->forceDelete();
        return redirect('/');
    }

    public function deleteDraft($id) {
        $deleteBlog = Blog::findOrFail($id);
        $deleteBlog->forceDelete();
        return redirect('/');
    }

    public function release($id) {
        $blog = Blog::findOrFail($id);
        $blog->status = 1;
        $blog->update();
        return redirect('/');
    }

    public function unrelease($id) {
        $blog = Blog::findOrFail($id);
        $blog->status = 0;
        $blog->update();
        return redirect('/');
    }

    public function unreleased() {        
        $unreleasedBlogs = Blog::where('status', 0)->latest()->get();        
        return view('blogs.unreleased', compact('unreleasedBlogs'));           
    }
    
}
