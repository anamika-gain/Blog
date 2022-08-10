<?php

namespace App\Http\Controllers\Api;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all(['id','title','slug','description']);
        return response()->json($blogs);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug'=>'required',
            'description' => 'required',
        ]);
        // $slug = str_slug($request->title);
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->description = $request->description;
    
        $blog->save();
        return response()->json([
            'message'=>'Blog Created Successfully!!',
            'blog'=>$blog
        ]);
    }

  
    public function show(Blog $blog)
    {
        return response()->json($blog);
    }

   
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required'
           
        ]);
        $blog->update($request->all());
        return response()->json([
            'message'=>'Blog Updated Successfully!!',
            'blog'=>$blog
        ]);
    }


    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json([
            'message'=>'Blog Deleted Successfully!!'
        ]);
    }
}
