<?php

return [
    'resources' => [
        \App\Enums\PageItemType::QUESTION->value => \App\Http\Resources\PageItems\QuestionResource::class,
        \App\Enums\PageItemType::SECTION->value => \App\Http\Resources\PageItems\SectionResource::class,
    ]
];
