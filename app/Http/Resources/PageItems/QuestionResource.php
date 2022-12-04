<?php

namespace App\Http\Resources\PageItems;

use App\Models\PageItem;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PageItem */
class QuestionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'image_id' => $this->image_id,
            'type' => $this->type->value,
            'response_type' => $this->response_type,
            'required' => $this->is_required,
            'params' => [
                'response_set' => $this->response_set,
                'multiple_selection' => $this->multiple_selection,
            ],
            'check_conditions_for' => $this->check_conditions_for,
            'categories' => $this->categories,
            'negative' => $this->is_negative,
            'notes_allowed' => $this->is_notes_allowed,
            'photos_allowed' => $this->is_photos_allowed,
            'issues_allowed' => $this->is_issues_allowed,
            'responded' => $this->is_responded,
        ];
    }
}
