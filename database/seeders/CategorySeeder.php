<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Beverages',
            'Bakery',
            'Dairy',
            'Produce',
            'Meat',
            'Seafood',
            'Frozen Foods',
            'Snacks',
            'Canned Goods',
            'Household',
            'Personal Care',
            'Health',
            'Office Supplies',
            'Electronics',
            'Clothing',
            'Footwear',
            'Toys',
            'Pet Supplies',
            'Home and Garden',
            'Automotive',
        ];

        foreach ($categories as $number => $name) {
            Category::query()->updateOrCreate(
                ['name' => $name],
                ['description' => sprintf('Demo inventory category %02d.', $number + 1)],
            );
        }
    }
}
