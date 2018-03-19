@extends('layouts.app') 
@section('content')
<br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Position</th>
      <th scope="col">Created_at</th>
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $category)
    <tr>
      <th scope="row">{{$category->id}}</th>
      <td>{{$category->name}}</td>
      <td>{{$category->position}}</td>
      <td>{{$category->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection