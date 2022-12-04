<?php

namespace Database\Factories;

use App\Models\Form;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'uuid' => $this->faker->uuid(),
            'is_collapsed' => $this->faker->boolean(),
            'form_id' => Form::factory(),
        ];
    }
}
