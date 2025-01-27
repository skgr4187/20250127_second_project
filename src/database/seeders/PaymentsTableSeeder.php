<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 商品を購入した時の支払い方法
        $payments = [
            "コンビニ支払い",
            "カード支払い",
        ];

        foreach ($payments as $payment) {
            DB::table('payments')->insert([
                'name' => $payment,
            ]);
        }
    }
}
