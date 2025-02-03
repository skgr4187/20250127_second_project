{{-- 新規会員登録画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <h1>会員登録</h1>
    <form class="register-form-inner" action="{{ route('user.register') }}" method="post">
        @csrf
        <div class="register-form-group">
            <label for="name">ユーザー名</label>
            <input class="form-item" type="text" id="name" name="name" value="{{ old('name') }}" />
            <div class="error-message">
                @error('name')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="register-form-group">
            <label for="email">メールアドレス</label>
            <input class="form-item" type="email" id="email" name="email" value="{{ old('email') }}" />
            <div class="error-message">
                @error('email')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="register-form-group">
            <label for="password">パスワード</label>
            <input class="form-item" type="password" id="password" name="password" />
            <div class="error-message">
                @error('password')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="register-form-group">
            <label for="confirm-password">確認用パスワード</label>
            <input class="form-item" type="password" id="password_confirmation" name="password_confirmation" />
            <div class="error-message">
                @error('password')
                {{$message}}
                @enderror
            </div>
        </div>
        <button type="submit" class="register-btn">登録する</button>
    </form>
    <a href="/login" class="login-link">ログインはこちら</a>
</div>
@endsection