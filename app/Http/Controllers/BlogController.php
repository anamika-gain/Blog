<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Blog::all();
        
        return view('blog.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug'=>'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        // $slug = str_slug($request->title);
        if ($image = $request->file('image')) {
            $destinationPathone = 'public/image';
            $image_one =hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move($destinationPathone, $image_one);
            $imageUrl = "$image_one";
        }
       
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->user_id = Auth::id();
        $blog->slug = $request->slug;
        $blog->image = $imageUrl;
        $blog->description = $request->description;
    
        $blog->save();
     
        return redirect()->route('blogs.create')
                        ->with('success','Post created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
             
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);
        $data=array();
    	$data['title']=$request->title;
    	$data['slug']=$request->slug;
    	$data['description']=$request->description;

        $old_image = $request->old_image;
 
  
        if ($image = $request->file('new_image')) {
            $destinationPathone = 'public/image';
            unlink('public/image'.$old_image);
            $image_one =hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move($destinationPathone, $image_one);
            $data['image'] = "$image_one";
        }else{
            unset($data['image']);
        }
        //  dd($input);
        $blog->update($data);


        return redirect()->route('blogs.index')
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {  
        $image1 = $blog->image;
        unlink('public/image/'.$image1);
        $blog->delete();
        return redirect()->route('blogs.index')
            ->with('success', 'Post deleted successfully');
    }
    public function post_details($slug)
    {  
        $blog = Blog::where('slug',$slug)->first();
        return view('blog.show',compact('blog'));

    }  
    public function blogByAuthor()
    {
        $posts = Auth::user()->blogs()->get();
        $post_count = Auth::user()->blogs()->count();
       
        
        return view('home',compact('posts','post_count'));
    }
}
