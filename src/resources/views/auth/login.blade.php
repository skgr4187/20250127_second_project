{{-- ログインページ --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-form">
    <h1>ログイン</h1>
    <form class="login-form-inner" action="{{ route('user.login') }}" method="post">
        @csrf
        <div class="login-form-group">
            <label for="name">ユーザー名/メールアドレス</label>
            <input class="form-item" type="email" id="email" name="email" value="{{ old('email') }}" />
            <div class="error-message">
                @error('email')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="login-form-group">
            <label for="password">パスワード</label>
            <input class="form-item" type="password" id="password" name="password" name="password" />
            <div class="error-message">
                @error('password')
                {{$message}}
                @enderror
            </div>
        </div>
        <button type="submit" class="login-btn">ログインする</button>
    </form>
    <a href="/register" class="register-link">会員登録はこちら</a>
</div>
@endsection