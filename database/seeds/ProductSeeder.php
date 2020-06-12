<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            DB::table('products')->insert([
                'categories_id' => $i,
                'brands_id' => $i,
                'name_product' => Str::random(6),
                'slug_product'=>Str::slug(Str::random(4), '-'),
                'image' => 'test-image-'.$i.'.png',
                'qty' => 3,
                'price' => 20000,
                'status' => 1,
                'sale_off' => null,
                'code_product' => null,
                'view' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ]);
        }
    }
}
