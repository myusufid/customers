<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\FamilyList;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FamilyListFactory extends Factory
{
    protected $model = FamilyList::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'fl_relation' => $this->faker->word(),
            'fl_name' => $this->faker->name(),
            'fl_dob' => Carbon::now(),

            'cst_id' => Customer::factory(),
        ];
    }
}
