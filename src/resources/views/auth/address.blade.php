{{-- 送付先住所変更画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/address.css') }}">
@endsection

@section('content')
<div class="address-inner">
    <h1>住所の変更</h1>
    <form action="{{ route('update.address', ['item_id' => $item->id])}}" method="post">
        @csrf
        <div class="address-form-group">
            <label for="postal_code">郵便番号</label>
            <input type="text" id="postal_code" name="postal_code" class="form-item" value="{{ old('postal_code', session('postal_code')) }}">
            <div class="error-message">
                @error('postal_code')
                    {{$message}}
                @enderror
            </div>
        </div>

        <div class="address-form-group">
            <label for="address">住所</label>
            <input type="text" id="address" name="address" class="form-item" value="{{ old('address', session('address')) }}">
            <div class="error-message">
                @error('address')
                    {{$message}}
                @enderror
            </div>
        </div>

        <div class="address-form-group">
            <label for="building">建物名</label>
            <input type="text" id="building" name="building" class="form-item" value="{{ old('building', session('building')) }}">
            <div class="error-message">
                @error('building')
                    {{$message}}
                @enderror
            </div>
        </div>
        <button class="address-btn" type="submit">更新する</button>
    </form>
</div>
@endsection
