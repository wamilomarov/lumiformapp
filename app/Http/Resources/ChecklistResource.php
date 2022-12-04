<?php

namespace App\Http\Resources;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Checklist */
class ChecklistResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'checklist_title' => $this->title,
            'checklist_description' => $this->description,
            'form' => new FormResource($this->whenLoaded('form')),
        ];
    }
}
