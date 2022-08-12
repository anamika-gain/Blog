@extends('blog.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>ALL POST</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('blogs.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Author</th>
            <th>Image</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
          @php
               $i=0;  
            @endphp
        @foreach ($posts as $post)
        <tr>
          
            <td>{{$i++ }}</td>
            
            <td>{{\Illuminate\Support\Str::limit($post->title,'10','...') }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->user->name }}</td>
            
            <td><img src="{{ asset('public/image/'.$post->image) }}" height="50px;"
                width="50px;"></td>
            <td>{{\Illuminate\Support\Str::limit($post->description,'20','...') }}</td>
            <td>
                <form action="{{ route('blogs.destroy',$post->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('blogs.show',$post->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('blogs.edit',$post->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  

      
@endsection