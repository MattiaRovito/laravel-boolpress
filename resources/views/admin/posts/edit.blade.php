@extends('layouts.app')

@section('content')


<div class="container">
    <form action="{{route('admin.posts.update', $post->id)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="mb-3">
          <label for="titolo" class="form-label">Titolo</label>
          <input type="text" class="form-control" id="titolo" name="title" value="{{$post->title}}">
         
        </div>

        <div class="mb-3">
          <label for="descrizione" class="form-label">Descrizione</label>
         <textarea name="content" id="" cols="30" rows="10" class="form-control" id="descrizione">{{$post->content}}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>









@endsection