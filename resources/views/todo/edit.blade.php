@php
        $title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
<div class="container">
<h1>Todo編集</h1>
 
    <form method="post" action="/edit">
      {{ csrf_field() }}
      <div class="form-group">
	<input type = "hidden" class = "form-controll" name = "id" value="{{$todo->id}}">
	<label for="titleInput">タイトル</label>
        <input type="text" class="form-control" id="titleInput" name="title" value="{{ $todo->title}}">
      </div>
      <div class="form-group">
        <label for="bodyInput">内容</label>
        <textarea class="form-control" id="detailInput" rows="3" name="detail">{{$todo->detail}}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">編集</button>
    </form>
</div>
@endsection
