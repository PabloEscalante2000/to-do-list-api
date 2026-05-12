<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "title" => fake()->words(3, true),
            "description" => fake()->paragraph(),
            "status" => fake()->randomElement(["Pendiente","Completado","Cancelado","En proceso"]),
        ];
    }
}
