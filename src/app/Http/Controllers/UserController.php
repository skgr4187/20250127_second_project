<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ExibitionRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\AddressRequest;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 新規会員登録処理
    public function store(RegisterRequest $request)
    {
        $form = $request->only(['name', 'email', 'password']);
        $form['password'] = Hash::make($form['password']);
        $user = User::create($form);

        // ログインしてプロフィール設定ページを表示する
        Auth::login($user);
        return redirect()->route('editMypage');
    }

    // ログインページを表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理をして商品一覧ページを表示
    public function login(LoginRequest $request)
    {
        // バリデーション済みのデータを取得
        $credentials = $request->validated();

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->route('products.index');
    }
        return back()->withErrors([
            'email' => 'ログイン情報が登録されていません。',
        ])->onlyInput('email');
    }

    // プロフィールページを表示
    public function showMypage(Request $request)
    {
        $tab = $request->query('tab', 'sell');
        $user = Auth::user();

        $items = collect();
        $orders = collect();
        if ($tab === 'sell') {
            // 出品した商品を表示する
            $items = Item::where('user_id', $user->id)->get();
        } elseif ($tab === 'buy') {
            // 購入した商品を表示する
            if ($user) {
                $orders = Order::where('user_id', $user->id)->with('item')->get();
            }
        }
        return view('auth.profile', compact('items', 'tab', 'user','orders'));
    }

    // プロフィール編集ページを表示
    public function editMypage(Request $request)
    {
        $user = Auth::user();
        return view('auth.profile-edit',compact('user'));
    }

    // 変更内容の保存処理をして商品一覧ページを表示
    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();

        // プロフィール画像のアップロード処理
        if ($request->hasFile('user_image')) {
            $imagePath = $request->file('user_image')->store('images', 'public');
            $user->image = $imagePath;
            }
        $user->update([
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('products.index',compact('user'));
    }
}
