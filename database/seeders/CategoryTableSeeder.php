<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Smartphones',
            'Laptops',
            'Smartwatches',
            'Audio',
            'Tablets',
            'Cameras'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        $orderStatus = [
            'created',
            'prepared',
            'in process',
            'dispatch',
            'pending',
            'delivered',
            'completed',
            'returned',
            'cancelled',
        ];

        foreach ($orderStatus as $order) {
            OrderStatus::create(['name' => $order]);
        }
    }
}
