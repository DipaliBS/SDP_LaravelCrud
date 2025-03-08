<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPurchaseHistorySeeder extends Seeder
{
    public function run()
    {
        DB::table('product_purchase_history')->insert([
            [
                'productid' => 1,
                'userid' => 1,
                'purchase_status' => 'completed',
            ],
            [
                'productid' => 2,
                'userid' => 2,
                'purchase_status' => 'completed',
            ],
            [
                'productid' => 1,
                'userid' => 2,
                'purchase_status' => 'completed',
            ],
        ]);
    }
}
