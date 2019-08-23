@php
	$title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
	<div class="container">
		<h1>Todo詳細</h1>

		<form method="post" action="/todos/{{$todo->id}}">
			@method('delete')
			@csrf
			<div class="form-group">
				<input type = "hidden" class = "form-controll" name = "id" value="{{$todo->id}}">
				<label for="titleInput">タイトル</label>
				<input type="text" class="form-control" readonly  id="titleInput" name="title" value="{{ $todo->title}}">
			</div>
			<div class="form-group">
				<label for="bodyInput">内容</label>
				<textarea class="form-control" id="detailInput" readonly rows="3" name="detail">{{$todo->detail}}</textarea>
			</div>
			<button type="button" onclick="location.href='/todos/{{$todo->id}}/edit'" class="btn btn-primary">編集</button>
			<button type="submit" class="btn btn-primary">削除</button>
		</form>
	</div>
@endsection
