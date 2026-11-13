<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::query()
            ->whereIn('name', [
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
            ])
            ->get()
            ->keyBy('name');

        foreach ($categories->values() as $number => $category) {
            $productNumber = $number + 1;
            $name = sprintf('Demo Product %02d', $productNumber);

            Product::query()->updateOrCreate(
                ['name' => $name],
                [
                    'category_id' => $category->id,
                    'description' => sprintf('Demo product %02d for inventory and point-of-sale testing.', $productNumber),
                    'price' => number_format(5 + ($productNumber * 1.35), 2, '.', ''),
                    'stock' => 10 + ($productNumber * 3),
                    'image' => null,
                    'is_active' => true,
                ],
            );
        }
    }
}
