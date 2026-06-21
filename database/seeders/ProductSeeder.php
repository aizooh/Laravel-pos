<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'USB Flash 16GB',      'category' => 'Storage',     'buying_price' => 350,  'selling_price' => 600,  'quantity' => 10],
            ['name' => 'Type-C Cable 1m',      'category' => 'Cables',      'buying_price' => 120,  'selling_price' => 250,  'quantity' => 20],
            ['name' => 'Earphones',            'category' => 'Audio',       'buying_price' => 200,  'selling_price' => 450,  'quantity' => 15],
            ['name' => 'Phone Case',           'category' => 'Accessories', 'buying_price' => 80,   'selling_price' => 200,  'quantity' => 30],
            ['name' => 'Screen Protector',     'category' => 'Accessories', 'buying_price' => 50,   'selling_price' => 150,  'quantity' => 25],
            ['name' => 'Power Bank 10000mAh',  'category' => 'Power',       'buying_price' => 1200, 'selling_price' => 2200, 'quantity' => 8 ],
            ['name' => 'OTG Adapter',          'category' => 'Cables',      'buying_price' => 80,   'selling_price' => 200,  'quantity' => 12],
            ['name' => 'Wireless Mouse',       'category' => 'Peripherals', 'buying_price' => 550,  'selling_price' => 1100, 'quantity' => 5 ],
            ['name' => 'HDMI Cable 2m',        'category' => 'Cables',      'buying_price' => 300,  'selling_price' => 650,  'quantity' => 7 ],
            ['name' => 'USB Hub 4-Port',       'category' => 'Peripherals', 'buying_price' => 400,  'selling_price' => 850,  'quantity' => 6 ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                array_merge($product, ['is_active' => true, 'low_stock_threshold' => 3])
            );
        }
    }
}
