<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 出品する商品のカテゴリー
        $categories = [
            "ファッション",
            "家電",
            "インテリア",
            "レディース",
            "メンズ",
            "コスメ",
            "本",
            "ゲーム",
            "スポーツ",
            "キッチン",
            "ハンドメイド",
            "アクセサリー",
            "おもちゃ",
            "ベビー・キッズ"
        ];
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }
    }
}
