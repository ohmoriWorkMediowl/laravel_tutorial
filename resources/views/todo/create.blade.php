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
	
	<input id="title" type="text" class="form-control @if($errors->has('title')) is-invalid @endif" name="title" value="{{old('title')}}" required autofocus>
           @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('title') }}
                </span>
		@endif

      </div>
      <div class="form-group">
	<label for="bodyInput">内容</label>
<textarea id="detail" class="form-control @if($errors->has('detail')) id-invalid @endif" name="detail" rows="8" required>{{ old('body') }}</textarea>
            @if ($errors->has('detail'))
                <span class="invalid-feedback" role="alert">
                    {{ $errors->first('detail') }}
                </span>
	    @endif
      </div>
      <button type="submit" class="btn btn-primary">新規追加</button>
    </form>
</div>
@endsection
