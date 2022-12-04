<?php

namespace App\Http\Requests\Forms;

use App\Enums\PageItemType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnswerFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'checklist_id' => ['required', 'exists:checklists,id'],
            'answers' => ['required', 'array'],
            'answers.*.uuid' => ['required', Rule::exists('page_items', 'uuid')->where('type', PageItemType::QUESTION->value)],
            'answers.*.answer' => ['nullable', 'sometimes'],
        ];
    }
}
