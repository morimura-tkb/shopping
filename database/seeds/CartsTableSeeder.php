<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carts = [['1','2','1'],
                ['1','3','10'],
                ['2','1','1']];

                foreach ($carts as $cart) {
                    DB::table('carts')->insert([
                    'user_id' => $cart[0],
                    'product_id' => $cart[1],
                    'number' => $cart[2],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }            
    
    }
}
