<?php

namespace App\Modules\Auth\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Auth\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Software Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'type' => 'super_admin',
            'created_by' => 1,

        ]);
    }
}
