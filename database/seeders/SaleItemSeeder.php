<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleItemSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::query()
            ->where('name', 'like', 'Demo Product %')
            ->orderBy('name')
            ->limit(20)
            ->get()
            ->values();

        $sales = Sale::query()
            ->where('notes', 'like', 'Seeded demo sale %')
            ->orderBy('notes')
            ->limit(20)
            ->get();

        foreach ($sales as $number => $sale) {
            $totalCents = 0;

            for ($offset = 0; $offset < 2; $offset++) {
                $product = $products[($number + $offset) % $products->count()];
                $quantity = (($number + $offset) % 3) + 1;
                $unitPriceCents = (int) round((float) $product->price * 100);
                $subtotalCents = $unitPriceCents * $quantity;
                $totalCents += $subtotalCents;

                $sale->items()->updateOrCreate(
                    ['product_id' => $product->id],
                    [
                        'product_name' => $product->name,
                        'unit_price' => number_format($unitPriceCents / 100, 2, '.', ''),
                        'quantity' => $quantity,
                        'subtotal' => number_format($subtotalCents / 100, 2, '.', ''),
                    ],
                );
            }

            $cashCents = $totalCents + 500 + ($number * 100);

            $sale->update([
                'total' => number_format($totalCents / 100, 2, '.', ''),
                'cash_tendered' => number_format($cashCents / 100, 2, '.', ''),
                'change_amount' => number_format(($cashCents - $totalCents) / 100, 2, '.', ''),
            ]);
        }
    }
}
