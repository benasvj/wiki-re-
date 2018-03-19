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
                <form action={{ route('categories.store') }} method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="name">Enter name</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                      <label for="position">Enter Position</label>
                      <input type="number" class="form-control" id="position" name="position">
                    </div>
                    <button type="submit" class="btn btn-success">Create Category</button>
                </form>
        </div>
    </div>
</div>
@endsection