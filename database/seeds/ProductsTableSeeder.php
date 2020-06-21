<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [['就活の勉強本','2000','10','0'],
                    ['ドラムスティック','800','0','0'],
                    ['ノンアルコールビール','200','100','0']];

        foreach ($products as $product) {
                DB::table('products')->insert([
                'name' => $product[0],
                'price' => $product[1],
                'stock' => $product[2],
                'limited' => $product[3],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
