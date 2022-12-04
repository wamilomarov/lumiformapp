<?php

namespace App\Http\Resources\PageItems;

use App\Http\Resources\PageItemResource;
use App\Models\PageItem;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PageItem */
class SectionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'uuid' => $this->uuid,
            'type' => $this->type->value,
            'repeat' => $this->is_repeat,
            'weight' => $this->weight,
            'required' => $this->is_required,
            'items' => PageItemResource::collection($this->whenLoaded('allItems')),
        ];
    }
}
