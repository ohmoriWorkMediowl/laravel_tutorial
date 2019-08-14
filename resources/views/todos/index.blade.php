@php
	$title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
	<div class="container">
		<h1>Todo一覧</h1>
		<div class="container">
			<form class="form-inline" action="{{url('/todos/index')}}">
				<div class="form-group">
					<input type="text" name="keyword" value="{{$keyword}}" placeholder="内容検索">
					<input type="submit" value="検索">
				</div>
			</form>
			<h2><a href="#ori1" data-toggle="collapse" >未完了Todo</a></h2>
			<div id="ori1" class="collapse show">
				@if($todos_notdone->count()==0)<span>未完了のtodoはありません</span>@endif
				@foreach ($todos_notdone as $todo_notdone)
					<div class="card mb-2">
						<div class="card-body">
							<h4 class="card-title"><a href="/todos/detail/{{$todo_notdone->id}}">{{ $todo_notdone->title }}</a></h4>
							<h6 class="card-subtitle mb-2 text-muted">{{ $todo_notdone->updated_at }}</h6>
							<p class="card-text">{{ $todo_notdone->detail }}</p>
							<form method="post" action="/todos/complete">
								{{ csrf_field() }}
								<input type="hidden" class="form-control" name="doneflg" value="{{$todo_notdone->doneflg}}">
								<input type="hidden" class="form-control" name="id" value="{{$todo_notdone->id}}">
								<button type="submit" class="btn btn-primary">完了</button>
							</form>
							<a href="/todos/{{$todo_notdone->id}}/edit" class="card-link">修正</a>
							<form method="post" action="/todos/{{ $todo_notdone->id}}/destroy" class="form-control">
								<input type="button" value="削除">
							</form>
						</div>
					</div>
				@endforeach
				{{$todos_notdone->links()}}
			</div>
		</div>
		<div class="container">
			<h2><a href="#ori2" data-toggle="collapse">完了済みTodo</a></h2>
			<div id="ori2" class="collapse show">
				@if($todos_done->count()==0)<span>完了済みのtodoはありません</span>@endif
				@foreach ($todos_done as $todo_done)
					<div class="card mb-2">
						<div class="card-body">
							<h4 class="card-title"><a href="/todos/detail/{{$todo_done->id}}">{{ $todo_done->title }}</a></h4>
							<h6 class="card-subtitle mb-2 text-muted">{{ $todo_done->updated_at }}</h6>
							<p class="card-text">{{ $todo_done->detail }}</p>
							<a href="/todos/{{ $todo_done->id}}/delete" class="card-link">削除</a>
						</div>
					</div>
				@endforeach
				{{$todos_done->links()}}
			</div>
		</div>
	</div>
@endsection
