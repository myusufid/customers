<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Nationality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'cst_name' => $this->faker->name(),
            'cst_dob' => '2024-07-31',
            'cst_phoneNum' => $this->faker->phoneNumber(),
            'cst_email' => $this->faker->unique()->safeEmail(),

            'nationality_id' => Nationality::factory(),
        ];
    }
}
