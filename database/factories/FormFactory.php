<?php

namespace Database\Factories;

use App\Models\Checklist;
use App\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FormFactory extends Factory
{
    protected $model = Form::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'checklist_id' => Checklist::factory(),
        ];
    }
}
