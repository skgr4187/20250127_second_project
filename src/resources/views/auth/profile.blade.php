{{-- プロフィール画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/profile.css') }}">
@endsection

@section('content')
<div class="profile-header">
    <div class="profile-image">
        @if($user->image)
            <img src="{{ $user->image }}" alt="プロフィール画像" class="user-image">
        @else
            <div class="image-none">
                <span>未設定</span>
            </div>
        @endif
    </div>
    <p class="user_name">{{ $user->name }}</p>
    <form action="{{ route('editMypage') }}" method="get">
        <button type="submit" class="profile-edit-btn">プロフィールを編集</button>
    </form>
</div>

<div class="inner">
    <div class="tab">
        <a href="{{ route('mypage.sell') }}" class="{{ $tab === 'sell' ? 'active' : '' }}">
            出品した商品
        </a>
        <a href="{{ route('mypage.buy') }}" class="{{ $tab === 'buy' ? 'active' : '' }}">
            購入した商品
        </a>

    </div>
    <hr>

    <!-- 出品した商品 -->
    @if($tab === 'sell')
        <div class="tab-content">
            @if($items->isNotEmpty())
                <div class="sell-inner">
                    @foreach($items as $item)
                        <div class="product">
                            <div class="product-card">
                                <a href="{{ route('products.show', ['item_id' => $item->id]) }}">
                                    <div class="product-image">
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="item">
                                    </div>
                                    <p class="product-name">{{ $item->name }}</p>
                                </a>
                                @if($item->is_sold)
                                    <p class="sold_out">Sold</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-message">出品した商品はありません。</p>
            @endif
        </div>
    @endif

    <!-- 購入した商品 -->
    @if($tab === 'buy')
        <div class="tab-content">
            @if($orders->isNotEmpty())
                <div class="buy-inner">
                    @foreach($orders as $order)
                        <div class="product">
                            <div class="product-card">
                                <a href="{{ route('products.show', ['item_id' => $order -> item->id]) }}">
                                    <div class="product-image">
                                        <img src="{{ $order->item->image }}" alt="{{ $order->item->name }}" class="item">
                                    </div>
                                    <p class="product-name">{{ $order->item->name }}</p>
                                </a>
                                <p class="sold_out">Sold</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-message">購入した商品はありません。</p>
            @endif
        </div>
    @endif
</div>
@endsection