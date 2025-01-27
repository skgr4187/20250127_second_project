{{-- 商品詳細画面 --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="product-inner">
    <div class="product-detail">
        <!-- 商品画像 -->
        <div class="product-image">
            <img src="{{ asset($item->image) }}" alt="商品画像" class="item">
        </div>

        <!-- 商品情報 -->
        <div class="product-info">
            <h1>{{$item->name}}</h1>
            <p class="brand">ブランド名</p>
            <div class="product-price">
                ￥<span class="price">{{ number_format($item->price) }}</span> (税込)
            </div>
            <div class="action">
                <div class="like-icon">
                    @if (auth()->check())
                        <form action="{{ route('products.action' , ['item_id' => $item->id]) }}" method="post" class="like-action">
                            @csrf
                            <input type="hidden" name="action" value="like">
                            <button type="submit" class="like">
                                @if (auth()->user()->likes()->where('item_id', $item->id)->exists())
                                    <!-- お気に入り解除 -->
                                    <i class="fas fa-star"></i>
                                @else
                                    <!-- お気に入り登録 -->
                                    <i class="far fa-star"></i>
                                @endif
                            </button>
                        </form>
                    @else
                        <!-- 未認証ユーザーはログインページに遷移する -->
                        <a href="{{ route('login') }}">
                            <i class="far fa-star"></i>
                        </a>
                    @endif
                    <p class="count">{{ $item->likes->count() }}</p>
                </div>
                <div class="comment-icon">
                    <i class="far fa-comment text-warning fa-2x"></i>
                    <p class="count">{{ $item->comments->count() }}</p>
                </div>
            </div>
            <form action="{{ route('purchase.create', ['item_id' => $item->id]) }}" method="get">
                <button type="submit" class="purchase-btn">購入手続きへ</button>
            </form>

            <div class="product-description">
                <h2>商品説明</h2>
                <div class="description">
                    {{$item->description}}
                </div>
            </div>

            <div class="product-info">
                <h2>商品の情報</h2>
                <div class="info-inner">
                    <div class="info-group">
                        <h3>カテゴリー</h3>
                        <div class="category-item">
                            @foreach($item->categories as $category)
                                <p class="category">{{ $category->name }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="info-group">
                        <h3>商品の状態</h3>
                        <p class="condition">{{$item->condition->name}}</p>
                    </div>
                </div>
            </div>



            <!-- コメント欄 -->
            <div class="comments-section">
                <h2 class="comment-title">コメント ({{ $item->comments->count() }})</h2>
                @if($item->comments->isEmpty())
                    <p class="comment-empty">コメントはまだありません。</p>
                @else
                    @foreach($item->comments as $comment)
                        <div class="comment">
                            <div class="comment-user">
                                <div class="profile-image">
                                    @if($comment->user->image)
                                        <img src="{{ asset($comment->user->image) }}" alt="{{ $comment->user->name }}" class="user-image">
                                    @else
                                        <div class="image-none">
                                            <span>{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="comment-user-name">{{ $comment->user->name }}</p>
                            </div>
                            <p class="comment-content">{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                @endif
                <form action="{{ route('products.action' , ['item_id' => $item->id]) }}" method="post">
                    @csrf
                    <div class="comment-form">
                        <h3>商品へのコメント</h3>
                        <input type="hidden" name="action" value="comment">
                        <textarea name="comment"></textarea>
                        <div class="error-message">
                            @error('comment')
                                {{$message}}
                            @enderror
                        </div>
                        @if (Auth::check())
                            <button type="submit" class="comment-btn">コメントを送信する</button>
                        @else
                            <form action="route{{'login'}}" method="get">
                                <button type="submit" class="comment-btn">コメントを送信する</button> 
                            </form>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
