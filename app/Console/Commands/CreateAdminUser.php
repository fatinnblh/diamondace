<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'make:admin';
    protected $description = 'Create an admin user';

    public function handle()
    {
        try {
            User::create([
                'name' => 'Admin',
                'email' => 'acethesis2u@gmail.com',
                'password' => Hash::make('Ace_thesis@2u'),
                'role' => 'admin'
            ]);

            $this->info('Admin user created successfully!');
        } catch (\Exception $e) {
            $this->error('Error creating admin user: ' . $e->getMessage());
        }
    }
}
