{{-- 商品購入画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-inner">
    <div class=content-left>
        <div class="product-form">
            <div class="product-image">
                <img src="{{ asset($item->image) }}" alt="商品画像" class="item">
            </div>
            <div class="info-item">
                <h2>{{$item->name}}</h2>
                <p class="product-price">¥ {{ number_format($item->price) }}</p>
            </div>
        </div>
        <hr>

        <div class="payment-form">
            <form action="{{ route('payment', ['item_id' => $item->id]) }}" class="payment-inner" method="post">
                @csrf
                <h3>支払い方法</h3>
                <label for="payment_id">
                    <select class="payment-select" id="payment_id" name="payment_id" onchange="this.form.submit()">
                        <option value="" disabled selected hidden>選択してください</option>
                        @foreach ($payments as $payment)
                            <option value="{{ $payment->id }}"
                                @if (session('payment_id') == $payment->id) selected @endif>
                            {{ $payment->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <div class="error-message">
                    @error('payment_id')
                        {{$message}}
                    @enderror
                </div>
            </form>
        </div>
        <hr>

        <div class="address-form">
            <form action="{{ route('purchase.address', ['item_id' => $item->id]) }}" class="title-edit" method="get">
                <h3>配送先</h3>
                <button class="edit-btn" type="submit">変更する</button>
            </form>
            <form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="post" class="user_address">
                @csrf
                <label for="shopping_address_default">
                    <input type="radio" id="shopping_address_default" name="shopping_address" value="default" 
                    {{ (session('shoppingAddress') && old('shopping_address', 'default') === 'default') ? 'checked' : '' }}>
                    〒 {{ $user->postal_code }}<br>
                    {{ $user->address }}
                    {{ $user->building }}
                </label>
                <!-- セッション情報がある場合 -->
                @if(session()->has('shoppingAddress'))
                <label for="shopping_address_session">
                    <input type="radio" id="shopping_address_session" name="shopping_address" value="session" 
                    {{ old('shopping_address') === 'session' ? 'checked' : '' }}>
                    〒 {{ session('shoppingAddress.postal_code') }}<br>
                    {{ session('shoppingAddress.address') }}
                    {{ session('shoppingAddress.building') }}
                </label>
                @else
                <!-- セッション情報がない場合 -->
                <label for="shopping_address_none">
                    <input type="radio" id="shopping_address_none" name="shopping_address" value="none" disabled>
                    登録情報がありません
                </label>
                @endif
                <div class="error-message">
                    @error('shopping_address')
                        {{$message}}
                    @enderror
                </div>
                <hr>
                <input type="hidden" name="payment_id" value="{{ session('payment_id') }}">
                <button class="purchase-btn" type="submit">購入する</button>
            </form>
        </div>
    </div>
    <div class="content-right">
        <table class="purchase-check">
            <tr>
                <td>商品代金</td>
                <td>¥ {{ number_format($item->price) }}</td>
            </tr>
            <tr>
                <td>支払方法</td>
                <td>
                    <!-- セッションに保存された値がある場合、paymentモデルにおけるidに対応するnameを表示する -->
                    @if(session('payment_id'))
                        {{ $payments->firstWhere('id', session('payment_id'))->name }}
                    @else
                        未選択
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
