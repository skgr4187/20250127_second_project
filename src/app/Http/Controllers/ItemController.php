<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ExhibitionRequest;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Condition;
use App\Models\Like;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Item;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    // 商品一覧ページを表示
    public function index(Request $request)
    {
        // デフォルトで'おすすめタブ'を表示
        $tab = $request->query('tab', 'recommended'); 
        // 検索ワード
        $query = $request->query('query');
        // ログインしているユーザーを確認
        $user = auth()->user();
        // 注文情報を取得
        $orders = Order::all();

        $baseQuery = Item::query();
        // 検索ワードが存在する場合、名前/商品説明に検索ワードが部分一致する商品を表示
        if ($query) {
            $baseQuery->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
            });
        }
        // マイリストを表示
        if ($tab === 'mylist') {
            // 未認証ユーザーの場合はログインページへ遷移
            if (!$user) {
                return redirect()->route('login');
            }

            // ログインユーザーのお気に入りを表示
            $likes = Like::where('user_id', $user->id)->with('item')->get();
            $items = $likes->map(function ($like) {
                return $like->item;
            });

            // ログインユーザーが出品した商品を除外し、検索条件を適用
            $items = $items->filter(function ($item) use ($user, $query) {
                $isNotUserItem = $item->user_id != $user->id;
                return $isNotUserItem;
            });
        } else {
            if ($user) {
                // ログイン中のユーザーが出品した商品を除外
                $baseQuery->where('user_id', '!=', $user->id);
            }
            $items = $baseQuery->get();
        }

        return view('index', compact('items', 'tab', 'query', 'user','orders'));
    }


    // 商品IDを取得して商品詳細ページを表示
    public function show($id)
    {
        // 商品状態を取得
        $conditions = Condition::all();
        // カテゴリーを取得
        $categories = Category::all();
        $item = Item::with(['condition', 'comments.user', 'categories'])->findOrFail($id);
        return view('product', compact('item', 'conditions', 'categories'));
    }

    // 商品出品ページを表示
    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('auth.exhibition', compact('categories', 'conditions'));
    }

    // 商品の出品処理
    public function store(ExhibitionRequest $request)
    {
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // 画像の保存処理
        $imagePath = $request->file('image')->store('public');
        $imagePath = str_replace('public/', 'storage/', $imagePath);

        // 商品を保存
        $item = Item::create([
            'user_id' => Auth::id(),
            'image' => $imagePath,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'condition_id' => $validated['condition_id'],
            'description' => $validated['description'],
        ]);

        // カテゴリーを中間テーブルに保存
        $item->categories()->attach($validated['categories']);

        return redirect()->route('products.index');
    }

    // お気に入り・コメント機能
    public function itemAction(Request $request, $item_id)
    {
        // 'action'パラメータを取得して処理を分岐
        $action = $request->input('action');

        switch ($action) {
            case 'like': // お気に入り登録・解除
                return $this->like($item_id);

            case 'comment': // バリデーションをしてコメント登録
                $commentRequest = app(CommentRequest::class);
                return $this->comment($commentRequest, $item_id);
        }
    }

    // お気に入り登録/解除の処理
    private function like($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = auth()->user();

        // ユーザーがすでにお気に入り登録しているか確認
        if ($user->likes()->where('item_id', $item_id)->exists()) {
            // 登録されていれば解除
            $user->likes()->detach($item_id); 
        } else {
            // 登録されていなければ新規登録
            $user->likes()->attach($item_id); 
        }

        return redirect()->back();
    }

    // コメント機能の処理
    private function comment(CommentRequest $request, $item_id)
    {
        $item = Item::findOrFail($item_id);
        $validated = $request->validated();

        // コメントを保存
        $item->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $validated['comment'], 
        ]);

        return redirect()->back(); 
    }
    
}
