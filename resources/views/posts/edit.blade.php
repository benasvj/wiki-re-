@extends('layouts.app')
@section('content')
<div class="containter">
    <div class="row justify-content-center">
        <div class="col-md-4">
                @if ($errors->any())
                  <div class="alert alert-danger">
                  <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                  </ul>
                  </div>
                @endif
                <form action={{ route('update_post', ['id' => $post->id]) }} method="POST">
                    @csrf
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" id="title" name="title" value=@isset($post->title) {{ $post->title}} @endisset>
                        </div>
                        <div class="form-group">
                          <label for="category">Select category</label>
                          <select class="form-control" id="category" name="category">
                            @foreach($categories as $category)
                              <option value={{$category->id}} @if($post->category==$category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Content</label>
                          <textarea class="form-control" id="content" name="content" rows="3">
                            @isset($post->content) {{ $post->content}} @endisset
                          </textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Update this Post</button>
                      </form>
        </div>
    </div>
</div>
@endsection