@php
        $title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
<div class="container">
<h1>Todo一覧</h1>
    <h1>Todo編集完了</h1>

    <div class="alert alert-primary" role="alert">
      修正しました。
      <a href="/" class="btn btn-primary">一覧に戻る</a>
    </div>
</div>
@endsection
