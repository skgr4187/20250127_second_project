{{-- 商品出品ページ --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/exhibition.css') }}">
@endsection

@section('content')
<div class="exhibition-form">
    <div class="inner">
    <h1>商品の出品</h1>
    <form class="exhibition-form-inner" action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3>商品画像</h3>
        <div class="image-group">
            <label class="custom-file-label" for="image">画像を選択する</label>
            <input type="file" name="image" id="image">
            <div class="error-message">
                @error('image')
                    {{$message}}
                @enderror
            </div>
        </div>
        <h2>商品の詳細</h2>
        <hr>
        <div class="form-group-category">
            <h3>カテゴリー</h3>
            @foreach ($categories as $category)
                <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="category_{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                <label class="checkbox-item" for="category_{{ $category->id }}">
                    {{ $category->name }}
                </label>
            @endforeach
            <div class="error-message">
                @error('categories')
                {{$message}}
                @enderror
            </div>
        </div>

        <h3>商品の状態</h3>
        <div class="exhibition-form-group">
            <label class="form-item-condition" for="condition_id">
                <select class="condition" name="condition_id" id="condition" >
                    <option value="" hidden>選択してください</option>
                    @foreach ($conditions as $condition)
                        <option value="{{ $condition->id }}"
                            @if(old('condition_id') == $condition->id) selected @endif>
                        {{ $condition->name }}
                        </option>
                    @endforeach
                </select>
            </label>
            <div class="error-message">
                @error('condition_id')
                {{$message}}
                @enderror
            </div>
        </div>

        <h2>商品名と説明</h2>
        <hr>
        <h3>商品名</h3>
        <div class="exhibition-form-group">
            <label class="form-item" for="name">
                <input class="product_name" type="text" name="name" id="name" value="{{ old('name') }}">
            </label>
            <div class="error-message">
                @error('name')
                {{$message}}
                @enderror
            </div>
        </div>

        <h3>商品の説明</h3>
        <div class="exhibition-form-group">
            <label class="form-item" for="description">
                <textarea class="description" name="description" id="description">{{ old('description') }}</textarea>
            </label>
            <div class="error-message">
                @error('description')
                {{$message}}
                @enderror
            </div>
        </div>

        <h3>販売価格</h3>
        <div class="exhibition-form-group">
            <label class="form-item" for="price">
                <input class="price" type="number" name="price" id="price" value="{{ old('price') }}" placeholder="￥">
            </label>
            <div class="error-message">
                @error('price')
                {{$message}}
                @enderror
            </div>
        </div>
        <button type="submit" class="exhibition-form-btn">出品する</button>
    </form>
    </div>
</div>
@endsection