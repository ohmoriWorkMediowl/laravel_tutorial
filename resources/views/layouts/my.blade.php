<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF トークン --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME') }}</title>

    {{-- CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- Navbarの左側 --}}
                    <ul class="navbar-nav mr-auto">
                        {{-- 「記事」と「ユーザー」へのリンク --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('TodoList') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/top') }}">{{ __('Recent Todo') }}</a>
                        </li>
                    </ul>

                    {{-- Navbarの右側 --}}
                    <ul class="navbar-nav ml-auto">
                        {{-- 投稿ボタン --}}
                        <li class="nav-item">
                            <a href="{{ url('/create') }}" id="new-todo" class="btn btn-success">
                                {{ __('New Todo') }}
                            </a>
                        </li>

                        {{-- 認証関連のリンク --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
	@if(session('my_status'))
		<div class="container mt-2">
			<div class="alert alert-success">
				{{ session('my_status')}}
			</div>
		</div>
	@endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- JavaScript --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
