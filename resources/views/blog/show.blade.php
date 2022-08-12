@extends('blog.layout')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
      <div class="pull-left">
          <h2></h2>
      </div>
      <div class="pull-right">
          <a class="btn btn-primary" href="{{ route('blogs.index') }}"> Back</a>
       
      </div>
  </div>
</div>
<br/>
<div class="card">
  <img src="{{ asset('public/image/'.$blog->image) }}"  class="card-img-top" alt="...">
    <div class="card-header">

      <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h5 class="card-title">Title : {{$blog->title}}</h5>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('blogs.create') }}">Written By{{ $blog->user->name }}</a>
            </div>
        </div>
    </div>
    </div>
    <div class="card-body">
 
      <p class="card-text"> {{$blog->description}}</p>
      <a href="{{route('blogs.index')}}"  class="card-link" style="padding: 0px">Go Back</a>
    </div>
  </div>

  <div class="pt-5">
    <h3 class="mb-5">{{$blog->comments()->count()}} Comments</h3>
    <ul class="comment-list">
        @foreach($blog->comments as $comment)
        <li class="comment">
                <div class="comment-body">
                <h3>{{$comment->user->name}}</h3>
                {{-- <div class="meta">{{ $comment->created_at->diffForHumans()}}</div> --}}
                <p>{{$comment->comment}}</p>
                <p><a href="#" class="reply rounded">Reply</a></p>
            </div>
        </li>
        @endforeach
    </ul>
    <!-- END comment-list -->

    <div class="comment-form-wrap pt-5">
        <h4 class="mb-5">Leave a comment</h4>
        @guest
            <p>For post a new comment. You need to login first. <a href="{{ route('login') }}">Login</a></p>
        @else
        <form method="post" action="{{ route('comment.store',$blog->id) }}" class="p-5 bg-light">
          @csrf
            <div class="form-group">
                <label for="message">Comment</label>
                <input name="comment" id="message"  class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Post Comment" class="btn btn-primary">
            </div>

        </form>
        @endguest
    </div>
</div>

  @endsection