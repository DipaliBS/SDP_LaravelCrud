<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductInteractionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_interactions')->insert([
            [
                'productid' => 1,
                'userid' => 1,
                'interaction_type' => 'view',
            ],
            [
                'productid' => 2,
                'userid' => 2,
                'interaction_type' => 'add_to_cart',
            ],
            [
                'productid' => 1,
                'userid' => 2,
                'interaction_type' => 'wishlist',
            ],
        ]);
    }
}

