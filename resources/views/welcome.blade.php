@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
@php
  $posts = DB::table('blogs')->get();
      @endphp
       @foreach($posts as $post)
        <div class="col-md-8" style="padding-bottom: 20px;">
            <div class="card">
                <div class="card-header" style="background: rgb(115, 181, 232)">{{$post->title}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                 {{$post->description}}
                </div>
                <a href="{{route('post.details',$post->slug)}}" class="card-link" style="padding: 20px">See Details</a>
            </div>
        </div>
   
      @endforeach
      
    </div>
</div>
@endsection