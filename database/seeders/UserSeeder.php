<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'ahdikhalida@gmail.com',
            'phone' => '082121212121',
            'password' => Hash::make('12345678'),
            'role' => Role::ADMIN->status(),
        ]);

        // php artisan db:seed --class=UserSeeder
    }
}
