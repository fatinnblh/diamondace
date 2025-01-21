<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'acethesis2u@gmail.com'],
            [
                'name' => 'Admin',
                'email' => 'acethesis2u@gmail.com',
                'password' => Hash::make('Ace_thesis@2u'),
                'role' => 'admin'
            ]
        );
    }
}
