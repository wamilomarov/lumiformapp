<?php

namespace Database\Factories;

use App\Enums\PageItemType;
use App\Models\Page;
use App\Models\PageItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PageItemFactory extends Factory
{
    protected $model = PageItem::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'uuid' => $this->faker->uuid(),
            'type' => $this->faker->randomElement(PageItemType::cases()),
            'weight' => $this->faker->randomNumber(),
            'image_id' => $this->faker->word(),
            'response_type' => $this->faker->word(),
            'response_set' => $this->faker->word(),
            'multiple_selection' => $this->faker->boolean(),
            'check_conditions_for' => $this->faker->words(),
            'categories' => $this->faker->words(),
            'is_required' => $this->faker->boolean(),
            'is_negative' => $this->faker->boolean(),
            'is_notes_allowed' => $this->faker->boolean(),
            'is_photos_allowed' => $this->faker->boolean(),
            'is_issues_allowed' => $this->faker->boolean(),
            'is_responded' => $this->faker->boolean(),
            'is_repeat' => $this->faker->boolean(),
            'page_id' => Page::factory(),
            'parent_id' => null,
            'value' => null,
        ];
    }
}
