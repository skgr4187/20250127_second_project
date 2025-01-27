{{-- 商品一覧画面（トップ画面） --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="inner">
    <div class="tab">
        <a href="{{ route('products.index', ['tab' => 'recommended', 'query' => request('query')]) }}" class="{{ $tab === 'recommended' ? 'active' : '' }}">
            おすすめ
        </a>
    @auth
        <a href="{{ route('products.index', ['tab' => 'mylist']) }}" class="{{ $tab === 'mylist' ? 'active' : '' }}">
           マイリスト
        </a>
    @else
        <a href="{{ route('login') }}" class="guest-tab">マイリスト</a>
    @endauth
    </div>
    <hr>
    <!-- おすすめ -->
    @if($tab === 'recommended')
        <div class="tab-content">
            <div class="recommended-inner">
                @foreach($items as $item)
                    <div class="product">
                        <div class="product-card">
                            <a href="{{ route('products.show', ['item_id' => $item->id]) }}">
                                <div class="product-image">
                                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="item">
                                </div>
                                <p class="product-name">{{ $item->name }}</p>
                            </a>
                            @if($orders->contains('item_id', $item->id))
                                <span class="sold_out">Sold</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- マイリスト -->
    @if($tab === 'mylist')
        <div class="tab-content">
            @if($items->isNotEmpty())
                <div class="likes-inner">
                    @foreach($items as $item)
                        <div class="product">
                            <div class="product-card">
                                <a href="{{ route('products.show', ['item_id' => $item->id]) }}">
                                    <div class="product-image">
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="product-image">
                                    </div>
                                    <p class="product-name">{{ $item->name }}</p>
                                </a>
                                @if($orders->contains('item_id', $item->id))
                                    <span class="sold_out">Sold</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="empty-message">お気に入り登録された商品はありません。</p>
            @endif
        </div>
    @endif
</div>
@endsection



