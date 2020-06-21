<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConnectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [['1','1','0'],
                    ['2','1','2'],
                    ['3','2','0']];

        foreach ($products as $product) {
                DB::table('connections')->insert([
                'product_id' => $product[0],
                'ref1' => $product[1],
                'ref2' => $product[2],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }            

    }
}
