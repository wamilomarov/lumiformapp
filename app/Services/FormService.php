<?php

namespace App\Services;

use App\DTO\PageItemAnswerDTO;
use App\Enums\PageItemType;
use App\Models\Checklist;
use App\Models\Form;
use App\Models\Page;
use App\Models\PageItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class FormService
{
    public function store(array $data): Checklist
    {
        $checklist = $this
            ->storeChecklist(
                Arr::get($data, 'checklist.checklist_title'),
                Arr::get($data, 'checklist.checklist_description'),
            );

        $form = $this->storeForm(
            $checklist,
            Arr::get($data, 'checklist.form.type'),
            Arr::get($data, 'checklist.form.uuid'),
        );

        $pagesData = Arr::get($data, 'checklist.form.items', []);
        $this->storePages($form, $pagesData);

        return $checklist;
    }

    public function show(Checklist $checklist): Checklist
    {
        return $checklist->load(['form.pages.allItems']);
    }

    public function answer(Checklist $checklist, array $answers): void
    {
        /** @var PageItemAnswerDTO $answer */
        foreach ($answers as $answer) {
            PageItem::query()
                ->where('type', PageItemType::QUESTION)
                ->whereRelation('page.form', 'checklist_id', $checklist->id)
                ->where('uuid', $answer->uuid)
                ->update([
                    'value' => $answer->answer,
                ]);
        }
    }

    public function findById(int $id): Model|Checklist
    {
        return Checklist::query()->findOrFail($id);
    }

    private function storeChecklist(string $title, string $description): Model|Checklist
    {
        return Checklist::query()
            ->create([
                'title' => $title,
                'description' => $description,
            ]);
    }

    private function storeForm(Checklist $checklist, string $type, string $uuid): Model|Form
    {
        return Form::query()
            ->create([
                'checklist_id' => $checklist->id,
                'type' => $type,
                'uuid' => $uuid,
            ]);
    }

    private function storePages(Form $form, array $pages): void
    {
        foreach ($pages as $pageData) {
            $page = Page::query()
                ->create([
                    'form_id' => $form->id,
                    'title' => Arr::get($pageData, 'title'),
                    'uuid' => Arr::get($pageData, 'uuid'),
                    'is_collapsed' => Arr::get($pageData, 'params.collapsed'),
                ]);

            $this->storePageItems(
                $page,
                Arr::get($pageData, 'items', []),
            );
        }
    }

    private function storePageItems(Page $page, array $items, ?PageItem $parent = null): void
    {
        foreach ($items as $item) {
            $pageItem = PageItem::query()
                ->create([
                    'page_id' => $page->id,
                    'parent_id' => $parent?->id,
                    'title' => Arr::get($item, 'title'),
                    'uuid' => Arr::get($item, 'uuid'),
                    'type' => Arr::get($item, 'type'),
                    'weight' => Arr::get($item, 'weight'),
                    'image_id' => Arr::get($item, 'image_id'),
                    'response_type' => Arr::get($item, 'response_type'),
                    'response_set' => Arr::get($item, 'params.response_set'),
                    'multiple_selection' => Arr::get($item, 'params.multiple_selection'),
                    'check_conditions_for' => Arr::get($item, 'check_conditions_for'),
                    'categories' => Arr::get($item, 'categories'),
                    'is_required' => Arr::get($item, 'required'),
                    'is_negative' => Arr::get($item, 'negative'),
                    'is_notes_allowed' => Arr::get($item, 'notes_allowed'),
                    'is_photos_allowed' => Arr::get($item, 'photos_allowed'),
                    'is_issues_allowed' => Arr::get($item, 'issues_allowed'),
                    'is_responded' => Arr::get($item, 'responded'),
                    'is_repeat' => Arr::get($item, 'repeat'),
                ]);

            $children = Arr::get($item, 'items');
            if ($children) {
                $this->storePageItems($page, $children, $pageItem);
            }
        }
    }
}
