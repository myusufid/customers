<?php

namespace Database\Factories;

use App\Models\Nationality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class NationalityFactory extends Factory
{
    protected $model = Nationality::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'nationality_name' => $this->faker->name(),
            'nationality_code' => 'AI',
        ];
    }
}
