<?php

namespace Database\Factories;


use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'source' => $this->faker->randomElement(['Fotocasa', 'Habitaclia']),
            'owner' => User::factory(), // Relación con un usuario (agent)
            'created_by' => User::factory()->state(['role' => 'manager']), // Creado por un manager
            'created_at' => now(),
        ];
    }
}