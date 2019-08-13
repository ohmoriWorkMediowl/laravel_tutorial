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
				<input type = "hidden" class = "form-control" name = "id" value="{{$todo->id}}">
				<label for="titleInput">タイトル</label>
				<input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="titleInput" name="title" value="{{ old('title', $todo->title)}}" required autofocus>
				@if($errors->has('title'))
					<span class="invalid-feedback" role="alert">
						{{ $errors->first('title')}}
					</span>
				@endif
			</div>
			<div class="form-group">
				<label for="detailInput">内容</label>
				<textarea class="form-control @if ($errors->has('detail')) is-invalid @endif" id="detailInput" rows="3" name="detail" required>{{old('detail', $todo->detail)}}</textarea>
				@if($errors->has('detail'))
					<span class="invalid-feedback" role="alert">
						{{ $errors->first('detail')}}
					</span>
				@endif
			</div>
			<button type="submit" class="btn btn-primary">編集</button>
		</form>
	</div>
@endsection
