@php
        $title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
<div class="container">
<h1>Todo新規追加</h1>
 
    <form method="post" action="/create">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="titleInput">タイトル</label>
        <input type="text" class="form-control" id="titleInput" name="title">
      </div>
      <div class="form-group">
        <label for="bodyInput">内容</label>
        <textarea class="form-control" id="detailInput" rows="3" name="detail"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">新規追加</button>
    </form>
</div>
@endsection
