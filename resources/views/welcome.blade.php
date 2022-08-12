@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
@php
  $posts = App\Models\Blog::all();
      @endphp
       @foreach($posts as $post)
        <div class="col-md-8" style="padding-bottom: 20px;">
            <div class="card">
                <div class="row g-0">
                <div class="col-md-12">
                    <img src="{{ asset('public/image/'.$post->image) }}" class="img-fluid rounded-start" alt="...">
                  </div>
                </div>
                <div class="card-header" style="background: rgb(115, 181, 232)">{{$post->title}}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                 {{$post->description}}
                </div>
                
                <div class="card-footer">
                    <a  class="card-link">Author : {{$post->user->name}}</a>
                    <a href="{{route('post.details',$post->slug)}}" class="card-link" style="padding-left: 600px">See Details</a>
                    
                  </div>
                
            </div>
        </div>
   
      @endforeach
    
    </div>
</div>
@endsection