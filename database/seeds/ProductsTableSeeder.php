<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['hugo red','sanloran'];

        foreach($products as $product){
            Product::create([
                'category_id'=>1,
                'name'=> $product,
                'description'=> $product .'  desc',
                'purchase_price'=>20000,
                'sale_price'=>25000,
                'stock'=>6,
            ]);

        }
    }
}
