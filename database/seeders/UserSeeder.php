<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create();
        User::factory()->author()->create();
        User::factory()->viewer()->create();
    }
}
