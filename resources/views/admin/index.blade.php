@extends('layouts.app') 
@section('content')
<br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Created_at</th>
      <th scope="col">Updated_at</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @forelse($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->title}}</td>
      <td>{{$post->content}}</td>
      <td>{{$post->created_at}}</td>
      <td>{{$post->updated_at}}</td>
      <td>
        <a href={{ route('posts.edit', ['id' => $post->id]) }} class="btn btn-info">EDIT</a>
      </td>
      <td>
        <form action={{ route('delete_post', ['id' => $post->id]) }} method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">DELETE</button>
        </form>
      </td>
    </tr>
    @empty
        <p>There are no posts created!</p>
    @endforelse
  </tbody>
</table>
{{ $posts->links() }}
@endsection