<?php

namespace App\Http\Requests\Logs;

use Illuminate\Foundation\Http\FormRequest;

class RequestLogIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'method' => ['sometimes'],
            'endpoint' => ['sometimes'],
        ];
    }
}
