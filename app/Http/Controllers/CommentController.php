<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request,$blog)
    {
      //  dd($blog);
        $this->validate($request,[
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->blog_id = $blog;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        // Toastr::success('Comment Successfully Published :)','Success');
        return redirect()->back();
    }


    public function show(Comment $comment)
    {
        //
    }


    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

 
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        Toastr::success('Comment Successfully Deleted','Success');
        return redirect()->back();
    }
}
