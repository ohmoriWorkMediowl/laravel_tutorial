@php
        $title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
<div class="container">
<h1>Todo一覧</h1>
<div class="container">
<h2>未完了Todo</h2>
@foreach ($todos as $todo)
    <div class="card mb-2">
      <div class="card-body">
        <h4 class="card-title"><a href="/detail/{{$todo->id}}">{{ $todo->title }}</a></h4>
        <h6 class="card-subtitle mb-2 text-muted">{{ $todo->updated_at }}</h6>
	<p class="card-text">{{ $todo->detail }}</p>
	<form method="post" action="/complete">
		{{ csrf_field() }}
		<input type="hidden" class="form-control" name="doneflg" value="{{$todo->doneflg}}">
		<input type="hidden" class="form-control" name="id" value="{{$todo->id}}">
		<button type="submit" class="btn btn-primary">完了</button>
	</form>
	<p class="card-text">{{ $todo->doneflg }}</p>
	<p class="card-text">{{ $todo->deadline }}</p>
	<p class="card-text">{{ $todo->uid }}</p>
	<a href="/edit/{{$todo->id}}" class="card-link">修正</a>
	<a href="/delete/{{ $todo->id}}" class="card-link">削除</a>
      </div>
    </div>
@endforeach
{{$todos->links()}}
</div>
<div class="container">
<h2>完了済みTodo</h2>
@foreach ($todos2 as $todo2)
    <div class="card mb-2">
      <div class="card-body">
        <h4 class="card-title"><a href="/detail/{{$todo2->id}}">{{ $todo2->title }}</a></h4>
        <h6 class="card-subtitle mb-2 text-muted">{{ $todo2->updated_at }}</h6>
        <p class="card-text">{{ $todo2->detail }}</p>
        <p class="card-text">{{ $todo2->doneflg }}</p>
        <p class="card-text">{{ $todo2->deadline }}</p>
        <p class="card-text">{{ $todo2->uid }}</p>
        <a href="/edit/{{$todo2->id}}" class="card-link">修正</a>
        <a href="/delete/{{ $todo2->id}}" class="card-link">削除</a>
      </div>
    </div>
@endforeach
{{$todos2->links()}}
</div>
</div>
@endsection
