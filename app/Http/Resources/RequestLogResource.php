<?php

namespace App\Http\Resources;

use App\Models\RequestLog;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin RequestLog */
class RequestLogResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'method' => $this->method,
            'endpoint' => $this->endpoint,
            'count' => $this->count,
        ];
    }
}
