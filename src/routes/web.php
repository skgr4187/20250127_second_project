<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;


// 商品一覧ページを表示
Route::get('/', [ItemController::class, 'index'])->name('products.index');

// 商品詳細ページを表示
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('products.show');

// 会員登録処理
Route::post('/register', [UserController::class, 'store'])->name('register');

// ログイン処理
Route::post('/login', [UserController::class, 'login'])->name('user.login');


Route::middleware('auth')->group(function () {

    // マイリストを表示
    Route::get('/?tab=mylist', [ItemController::class, 'myList'])->name('products.myList');

    // 商品出品ページを表示
    Route::get('/sell', [ItemController::class, 'create'])->name('sell.create');

    // 商品出品処理
    Route::post('/sell', [ItemController::class, 'store'])->name('sell.store');

    // 商品購入ページを表示
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'create'])->name('purchase.create');

    // 商品購入処理
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');

    // 支払方法の選択
    Route::post('/purchase/payment/{item_id}', [PurchaseController::class, 'payment'])->name('payment');

    // 送付先住所変更ページを表示
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'editAddress'])->name('purchase.address');

    // 送付先住所変更処理
    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress'])->name('update.address');

    // お気に入り登録/削除、コメント登録
    Route::post('/item/{item_id}', [ItemController::class, 'itemAction'])->name('products.action');

    // プロフィールページを表示
    Route::get('/mypage', [UserController::class, 'showMypage'])->name('showMypage');

    // プロフィール編集ページを表示
    Route::get('/mypage/profile', [UserController::class, 'editMypage'])->name('editMypage');

    // プロフィール変更内容保存処理
    Route::post('/mypage/profile', [UserController::class, 'update'])->name('updateMypage');

    // プロフィールページを表示(購入した商品)
    Route::get('/mypage?tab=buy', [UserController::class, 'buy'])->name('mypage.buy');

    // プロフィールページを表示(出品した商品)
    Route::get('/mypage?tab=sell', [UserController::class, 'sell'])->name('mypage.sell');


});
