<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()
            ->where('email', 'like', 'demo.user%')
            ->orderBy('email')
            ->limit(20)
            ->get();

        foreach ($users as $number => $user) {
            Sale::query()->updateOrCreate(
                ['notes' => sprintf('Seeded demo sale %02d', $number + 1)],
                [
                    'user_id' => $user->id,
                    'total' => '0.00',
                    'cash_tendered' => '0.00',
                    'change_amount' => '0.00',
                    'status' => 'completed',
                ],
            );
        }
    }
}
