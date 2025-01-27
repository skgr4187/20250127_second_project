{{-- プロフィール編集画面（設定画面） --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/profile-edit.css') }}">
@endsection

@section('content')
<div class="profile-form">
    <h1>プロフィール設定</h1>
    <form action="{{ route('updateMypage')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="image">
            <div class="profile-image">
                @if($user->image)
                    <img src="{{ $user->image }}" alt="プロフィール画像" class="user-image">
                @else
                    <div class="image-none">
                        <span>未設定</span>
                    </div>
                @endif
            </div>
            <label for="user_image" class="custom-file-label">画像を選択する</label>
            <input type="file" name="user_image" id="user_image">
        </div>
        <div class="error-message">
                @error('user_image')
                    {{$message}}
                @enderror
        </div>
        <div class="profile-form-group">
            <label for="name">ユーザー名</label>
            <input class="form-item" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" />
            <div class="error-message">
                @error('name')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="profile-form-group">
            <label for="postal_code">郵便番号</label>
            <input class="form-item" type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" />
            <div class="error-message">
                @error('postal_code')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="profile-form-group">
            <label for="address">住所</label>
            <input class="form-item" type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
            <div class="error-message">
                @error('address')
                    {{$message}}
                @enderror
            </div>
        </div>
        <div class="profile-form-group">
            <label for="building">建物名</label>
            <input class="form-item" type="text" id="building" name="building" value="{{ old('building', $user->building) }}">
            <div class="error-message">
                @error('building')
                    {{$message}}
                @enderror
            </div>
        </div>
        <button type="submit" class="profile-edit-btn">更新する</button>
    </form>
</div>
@endsection