<?php

namespace App\Http\Resources;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Page */
class PageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'uuid' => $this->uuid,
            'type' => 'page',
            'params' => [
                'collapsed' => $this->is_collapsed,
            ],
            'items' => PageItemResource::collection($this->whenLoaded('allItems')),
        ];
    }
}
