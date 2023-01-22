<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApprovedPayment>
 */
class ApprovedPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = ["Contract", 'claim', 'consultancy'];
        return [
            'approval_date' => $this->faker->date,
            'description' => $this->faker->sentence,
            'amount' =>  random_int(10000, 50000),
            'beneficiary' => $this->faker->name,
            'type' => $type[rand(0, 2)],
            'attachments' => json_encode(["1.jpg", "2.jpg", "3.jpg"]),
        ];
    }
}