<?php

namespace App\Http\Requests\Forms;

use App\Enums\PageItemType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateFormRequest extends FormRequest
{
    public function rules(): array
    {
//        dd($this->all());
        return [
            'checklist' => ['required', 'array:checklist_title,checklist_description,form'],
            'checklist.checklist_title' => ['required', 'string'],
            'checklist.checklist_description' => ['required', 'string'],
            'checklist.form' => ['required', 'array:uuid,type,items'],
            'checklist.form.uuid' => ['required', 'unique:forms,uuid'],
            'checklist.form.type' => ['required'],
            'checklist.form.items' => ['required', 'array'],
            'checklist.form.items.*' => ['required', 'array:title,uuid,type,items,params'],
            'checklist.form.items.*.title' => ['required', 'string'],
            'checklist.form.items.*.uuid' => ['required', 'unique:pages,uuid'],
            'checklist.form.items.*.type' => ['required'],
            'checklist.form.items.*.params' => ['required', 'array:collapsed'],
            'checklist.form.items.*.params.collapsed' => ['required', 'boolean'],
            'checklist.form.items.*.items' => ['sometimes', 'array'],
            'checklist.form.items.*.items.*' => ['required', 'array'],
            'checklist.form.items.*.items.*.uuid' => ['required', 'unique:page_items,uuid'],
            'checklist.form.items.*.items.*.title' => ['required', 'string'],
            'checklist.form.items.*.items.*.image_id' => ['nullable', 'sometimes', 'string'],
            'checklist.form.items.*.items.*.type' => ['required', new Enum(PageItemType::class)],
            'checklist.form.items.*.items.*.repeat' => ['sometimes'],
            'checklist.form.items.*.items.*.weight' => ['sometimes'],
            'checklist.form.items.*.items.*.response_type' => ['sometimes'],
            'checklist.form.items.*.items.*.required' => ['required', 'boolean'],
            'checklist.form.items.*.items.*.params' => ['sometimes', 'array:response_set,multiple_selection'],
            'checklist.form.items.*.items.*.params.response_set' => ['sometimes', 'string'],
            'checklist.form.items.*.items.*.params.multiple_selection' => ['sometimes', 'boolean'],
            'checklist.form.items.*.items.*.check_conditions_for' => ['sometimes', 'array'],
            'checklist.form.items.*.items.*.categories' => ['sometimes', 'array'],
            'checklist.form.items.*.items.*.negative' => ['sometimes', 'boolean'],
            'checklist.form.items.*.items.*.notes_allowed' => ['sometimes', 'boolean'],
            'checklist.form.items.*.items.*.photos_allowed' => ['sometimes', 'boolean'],
            'checklist.form.items.*.items.*.issues_allowed' => ['sometimes', 'boolean'],
            'checklist.form.items.*.items.*.responded' => ['sometimes', 'boolean'],
        ];
    }
}
