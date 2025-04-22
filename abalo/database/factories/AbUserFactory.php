<?php

namespace Database\Factories;

use App\Models\AbUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AbUser>
 */
class AbUserFactory extends Factory
{
    protected $model = AbUser::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ab_name' => $this->faker->unique()->name(),
            'ab_password' => $this->faker->password(),
            'ab_email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
