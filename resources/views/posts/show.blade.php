@extends('layouts.app')
@section('content')
<div class="containter">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center mt-5">
                    <div class="card-header">
                        {{ $post->title }}
                    </div>
                    <div class="card-body">
                      {{--  <h5 class="card-title">Special title treatment</h5>  --}}
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <p>Kategorija: {{ $post->cat->name }}</p>
                        {{ $post->created_at }}
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection