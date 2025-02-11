
@php
        $title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
<div class="container">
<h1>最新のTodo</h1>
@if ($todo)
    <div class="card mb-2">
      <div class="card-body">
        <h4 class="card-title">{{ $todo->title }}</h4>
        <h6 class="card-subtitle mb-2 text-muted">{{ $todo->updated_at }}</h6>
        <p class="card-text">{{ $todo->detail }}</p>
        <a href="/edit/{{$todo->id}}" class="card-link">修正</a>
        <a href="/delete/{{ $todo->id}}" class="card-link">削除</a>
      </div>
    </div> 
</div>
@endif
@if(!$todo)<span>未完了のtodoはありません</span>@endif
@endsection
