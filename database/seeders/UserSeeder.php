<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        for ($number = 1; $number <= 20; $number++) {
            $email = sprintf('demo.user%02d@example.test', $number);

            User::query()->updateOrCreate(
                ['email' => $email],
                [
                    'name' => sprintf('Demo User %02d', $number),
                    'password' => 'password',
                ],
            );
        }
    }
}
