@extends('layouts.app')
@section('content')
<div class="containter">
    <div class="row justify-content-center">
            <div class="col-2 mt-5">
                <h2>Categories</h2>
                <ul>
                    @foreach($categories as $category)
                    <li><a href={{route('filter_posts', ['id' => $category->id])}}>{{$category->name}} ({{$catNr[$loop->index]}})</a></li>   
                    @endforeach
                </ul>
        </div>
        <div class="col-md-8">
            @forelse($posts as $post) 
            <div class="card text-center mt-5">
                    <div class="card-header">
                        <a href={{ route('posts.show', ['id' => $post->id])}} > {{ $post->title }} </a>
                    </div>
                    <div class="card-body">
                      {{--  <h5 class="card-title">Special title treatment</h5>  --}}
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $post->created_at }}
                    </div>
            </div>
            @empty
                <p>Posts not found...</p>
            @endforelse
            <br>
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection