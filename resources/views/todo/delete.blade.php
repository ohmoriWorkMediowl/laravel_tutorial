@php
        $title = env('APP_NAME');
@endphp


@extends('layouts.my')
@section('title', 'laravel_practice')
@section('content')
<div class="container">
    <h1>Todo削除完了</h1>

    <div class="alert alert-primary" role="alert">
      削除しました。
      <a href="/" class="btn btn-primary">一覧に戻る</a>
    </div>
</div>
@endsection
