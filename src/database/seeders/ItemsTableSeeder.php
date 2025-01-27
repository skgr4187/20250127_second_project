<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        // 商品データ
        $items = [
            [
                'user_id' => 1,
                'name' => '腕時計',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'price' => 15000,
                'condition_id' => 1,
                'category_id' => [1, 5],
                'image' => 'storage/Armani+Mens+Clock.jpg',
            ],

            [
                'user_id' => 2,
                'name' => 'HDD',
                'description' => '高速で信頼性の高いハードディスク',
                'price' => 5000,
                'condition_id' => 2,
                'category_id' => [2],
                'image' => 'storage/HDD+Hard+Disk.jpg',
            ],

            [
                'user_id' => 3,
                'name' => '玉ねぎ3束',
                'description' => '新鮮な玉ねぎ3束のセット',
                'price' => 300,
                'condition_id' => 3,
                'category_id' => [10],
                'image' => 'storage/iLoveIMG+d.jpg',
            ],

            [
                'user_id' => 1,
                'name' => '革靴',
                'description' => 'クラシックなデザインの革靴',
                'price' => 4000,
                'condition_id' => 4,
                'category_id' => [1, 5],
                'image' => 'storage/Leather+Shoes+Product+Photo.jpg',
            ],

            [
                'user_id' => 2,
                'name' => 'ノートPC',
                'description' => '高性能なノートパソコン',
                'price' => 45000,
                'condition_id' => 1,
                'category_id' => [2],
                'image' => 'storage/Living+Room+Laptop.jpg',
            ],

            [
                'user_id' => 3,
                'name' => 'マイク',
                'description' => '高音質のレコーディング用マイク',
                'price' => 8000,
                'condition_id' => 2,
                'category_id' => [2],
                'image' => 'storage/Music+Mic+4632231.jpg',
            ],

            [
                'user_id' => 1,
                'name' => 'ショルダーバッグ',
                'description' => 'おしゃれなショルダーバッグ',
                'price' => 3500,
                'condition_id' => 3,
                'category_id' => [1, 4],
                'image' => 'storage/Purse+fashion+pocket.jpg',
            ],

            [
                'user_id' => 2,
                'name' => 'タンブラー',
                'description' => '使いやすいタンブラー',
                'price' => 500,
                'condition_id' => 4,
                'category_id' => [10],
                'image' => 'storage/Tumbler+souvenir.jpg',
            ],

            [
                'user_id' => 3,
                'name' => 'コーヒーミル',
                'description' => '手動のコーヒーミル',
                'price' => 4000,
                'condition_id' => 1,
                'category_id' => [10],
                'image' => 'storage/Waitress+with+Coffee+Grinder.jpg',
            ],

            [
                'user_id' => 1,
                'name' => 'メイクセット',
                'description' => '便利なメイクアップセット',
                'price' => 2500,
                'condition_id' => 2,
                'category_id' => [6],
                'image' => 'storage/cosme.jpg',
            ],
        ];

        foreach ($items as $itemData) {
            // 商品データ挿入
            $item = Item::create([
                'user_id' => $itemData['user_id'],
                'name' => $itemData['name'],
                'description' => $itemData['description'],
                'price' => $itemData['price'],
                'condition_id' => $itemData['condition_id'],
                'image' => $itemData['image'],
            ]);
            $item->categories()->attach($itemData['category_id']);
        }
    }
}
