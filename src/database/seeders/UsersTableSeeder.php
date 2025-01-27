<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpass'),
            'postal_code' => '163-8001',
            'address' => '東京都新宿区西新宿2-8-1',
            'building' => '東京都庁',
            'image' => 'storage/kaisya_desk1_syachou_young_man.png',
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'admin2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('adminpass2'),
            'postal_code' => '100-8929',
            'address' => '東京都千代田区霞が関2丁目1-1',
            'building' => '警視庁本部庁舎',
            'image' => 'storage/job_police_man.png',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'admin3',
            'email' => 'admin3@example.com',
            'password' => Hash::make('adminpass3'),
            'postal_code' => '100-0005',
            'address' => '東京都千代田区丸の内一丁目9番1号',
            'building' => '東京駅',
            'image' => 'storage/job_ekiin_woman.png',
        ];
        DB::table('users')->insert($param);
    }
}
