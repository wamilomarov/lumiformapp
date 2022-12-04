<?php

namespace App\Http\Controllers;

use App\DTO\PageItemAnswerDTO;
use App\Http\Requests\Forms\AnswerFormRequest;
use App\Http\Requests\Forms\CreateFormRequest;
use App\Http\Resources\ChecklistResource;
use App\Models\Checklist;
use App\Services\FormService;

class FormController extends Controller
{
    public function __construct(protected FormService $formService)
    {
    }

    public function store(CreateFormRequest $request)
    {
        $checklist = $this->formService->store($request->validated());
        $checklist = $this->formService->show($checklist);

        return ChecklistResource::make($checklist);
    }

    public function show(Checklist $checklist)
    {
        $checklist = $this->formService->show($checklist);

        return ChecklistResource::make($checklist);
    }

    public function answer(AnswerFormRequest $request)
    {
        /** @var Checklist $checklist */
        $checklist = $this->formService->findById($request->get('checklist_id'));
        $answers = PageItemAnswerDTO::arrayOf($request->validated('answers'));

        $this->formService->answer($checklist, $answers);

        $checklist = $this->formService->show($checklist);

        return ChecklistResource::make($checklist);
    }
}
