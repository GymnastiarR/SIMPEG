<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $admin = \App\Models\User::where('role', 'admin')->first();

        return [
            'content' => $this->faker->sentence,
            'user_id' => $admin ? $admin->id : \App\Models\User::factory(),
            'target' => 'department',
            'read_at' => null,
        ];
    }
}
