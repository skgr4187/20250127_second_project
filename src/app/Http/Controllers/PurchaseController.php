<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Item;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 商品購入ページを表示
    public function create(Request $request,$item_id)
    {
        $user = Auth::user();
        // 購入する商品を取得
        $item = Item::findOrFail($item_id);
        // 支払方法を全て取得
        $payments = Payment::all();

        return view('auth.purchase', compact('user','item', 'payments'));
    }


    // 商品購入処理
    public function store(PurchaseRequest $request, $item_id)
    {
        // ラジオボタンで選択された配送先のタイプを取得
        $selectedAddress = $request->input('shopping_address');

        $user = Auth::user();
        $item = Item::findOrFail($item_id);
        
        // 選択された住所によって保存するデータを変更
        if ($selectedAddress === 'default') {
            $postalCode = $user->postal_code;
            $address = $user->address;
            $building = $user->building;
        } elseif ($selectedAddress === 'session' && session('shoppingAddress')){
            $postalCode = session('shoppingAddress.postal_code');
            $address = session('shoppingAddress.address');
            $building = session('shoppingAddress.building');
        }


        // 注文情報を作成
        $order = Order::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'price' => $item ->price,
            'payment_id' => session('payment_id'),
            'postal_code' => $postalCode,
            'address' => $address,
            'building' => $building,
        ]);

        // セッション情報を削除
        session()->forget(['payment_id', 'shoppingAddress']);

        // 商品一覧ページを表示
        return redirect()->route('products.index');
    }

    // 支払方法をセッションに保存する
    public function payment(Request $request, $item_id)
    {
       $payment_id = $request->input('payment_id');
        if (!$payment_id) {
            return redirect()->route('purchase.create', ['item_id' => $item_id]);
        }

        // セッションに保存
        session(['payment_id' => $payment_id]);

        // 支払方法更新後、購入ページにリダイレクト
        return redirect()->route('purchase.create', ['item_id' => $item_id]);
    }

    // 住所変更ページを表示
    public function editAddress($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('auth.address', compact('item'));
    }

    // 更新した住所をセッションに保存
    public function updateAddress(AddressRequest $request,$item_id)
    {
        $item = Item::findOrFail($item_id);

        // バリデーション済みのデータをセッションに保存
        $request->session()->put('shoppingAddress', [
            'postal_code' => $request->input('postal_code'),
            'address' => $request->input('address'),
            'building' => $request->input('building')
        ]);
        
        // 購入画面へリダイレクト
        return redirect()->route('purchase.create', ['item_id' => $item_id]);
    }
}
