@php
        $title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
<div class="container">
    <h1>Todo新規追加完了</h1>

    <div class="alert alert-primary" role="alert">
      新規追加しました。
      <a href="/" class="btn btn-primary">一覧に戻る</a>
    </div>
</div>
@endsection
