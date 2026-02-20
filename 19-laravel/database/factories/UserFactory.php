<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Elegir género aleatorio
        $gender = fake()->randomElement(['Male', 'Female']);

        // Generar nombre que coincida con el género
        $firstName = $gender === 'Male'
            ? fake()->firstName('male')
            : fake()->firstName('female');

        $fullname = $firstName . ' ' . fake()->lastName();

        return [
            'document' => fake()->unique()->numberBetween(10000000, 99999999),
            'fullname' => $fullname,
            'gender' => $gender,
            'birthdate' => fake()->dateTimeBetween('1976-01-01', '2006-12-31')->format('Y-m-d'),
            'photo' => 'images/users/default.png',
            'phone' => fake()->numerify('3#########'),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('12345'),
            'active' => fake()->boolean(85),
            'role' => fake()->randomElement(['Admin', 'Customer', 'Customer', 'Customer']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
        'email_verified_at' => null,
        ]);
    }
}
