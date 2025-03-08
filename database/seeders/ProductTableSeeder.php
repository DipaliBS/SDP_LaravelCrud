<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('product')->insert([
            [
                'userid' => 1,
                'name' => 'Product A',
                'description' => 'Description of Product A',
                'price' => 100.00,
            ],
            [
                'userid' => 2,
                'name' => 'Product B',
                'description' => 'Description of Product B',
                'price' => 150.00,
            ],
        ]);
    }
}

