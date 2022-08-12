@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                    $posts = Auth::user()->blogs()->get();
                    $post_count = Auth::user()->blogs()->count();
                   
                    @endphp
                    
                    @if($post_count=="0")
                        {{ __('Welcome to your dashboard.You Do not Hava any post.') }}
                    
                    @else

                       <h5>Welcome to your dashboard.</h5>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="container">
@foreach ($posts as $post)
<div class="card mb-3" style="max-width: 900px; margin-left:200px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ asset('public/image/'.$post->image) }}" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{\Illuminate\Support\Str::limit($post->description,'200','...') }}</p>
          <a href="{{route('post.details',$post->slug)}}" class="card-link">See More</a>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
