<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Enums\UserRoleEnum;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password', 
            'remember_token' => Str::random(10),
            'role' => UserRoleEnum::Viewer,
        ];
    }

    public function admin(): static
    {
        return $this->state(fn() => [
            'username' => 'admin',
            'name' => 'Asep',
            'email' => 'admin@example.com',
            'password' => 'admin123',
            'role' => UserRoleEnum::Administrator,
        ]);
    }

    public function author(): static
    {
        return $this->state(fn() => [
            'username' => 'author',
            'name' => 'Asep',
            'email' => 'author@example.com',
            'password' => 'author123',
            'role' => UserRoleEnum::Author,
        ]);
    }

    public function viewer(): static
    {
        return $this->state(fn() => [
            'username' => 'viewer',
            'name' => 'Asep',
            'email' => 'viewer@example.com',
            'password' => 'viewer123',
            'role' => UserRoleEnum::Viewer,
        ]);
    }
}
