@php
        $title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
<div class="container">
<h1>Todo一覧</h1>
<div class="container">
<form class="form-inline" action="{{url('/')}}">
<div class="form-group">
	<input type="text" name="keyword" value="{{$keyword}}" placeholder="内容検索">
<input type="submit" value="検索">
</div>
</form>
<h2><a href="#ori1" data-toggle="collapse" >未完了Todo</a></h2>
<div id="ori1" class="collapse show">
@foreach ($todos as $todo)
@if ($todo->uid == Auth::id())
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
	<a href="/edit/{{$todo->id}}" class="card-link">修正</a>
	<a href="/delete/{{ $todo->id}}" class="card-link">削除</a>
      </div>
    </div>
@endif
@endforeach
{{$todos->links()}}
</div>
</div>
<div class="container">
<h2><a href="#ori2" data-toggle="collapse">完了済みTodo</a></h2>
<div id="ori2" class="collapse show">
@foreach ($todos2 as $todo2)
@if ($todo2->uid == Auth::id())
    <div class="card mb-2">
      <div class="card-body">
        <h4 class="card-title"><a href="/detail/{{$todo2->id}}">{{ $todo2->title }}</a></h4>
        <h6 class="card-subtitle mb-2 text-muted">{{ $todo2->updated_at }}</h6>
        <p class="card-text">{{ $todo2->detail }}</p>
        <a href="/delete/{{ $todo2->id}}" class="card-link">削除</a>
      </div>
    </div>
@endif
@endforeach
{{$todos2->links()}}
</div>
</div>
</div>
@endsection
