<?php

namespace App\Http\Resources;

use App\Models\PageItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PageItem */
class PageItemResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var JsonResource $resourceClass */
        $resourceClass = config("page_items.resources.{$this->type->value}");
        /** @var JsonResource $resource */
        $resource = $resourceClass::make($this->resource);

        return $resource->toArray($request);
    }
}
