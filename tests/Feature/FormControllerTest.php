<?php

namespace Tests\Feature;

use App\Enums\PageItemType;
use App\Models\Checklist;
use App\Models\Form;
use App\Models\Page;
use App\Models\PageItem;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FormControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_invalid_data_sending()
    {
        $data = [
            'checklist' => [
                'checklist_title' => 'Checklist',
                'checklist_description' => 'Description',
                'form' => [
                    'items' => [
                        [
                            'title' => 'Page',
                            'type' => 'page',
                            'items' => [
                                [
                                    'type' => 'unknown',
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = $this->postJson('/api/form', $data);

        $response->assertJsonValidationErrorFor('checklist.form.uuid');
        $response->assertJsonValidationErrorFor('checklist.form.type');
        $response->assertJsonValidationErrorFor('checklist.form.items.0.uuid');
        $response->assertJsonValidationErrorFor('checklist.form.items.0.params');
        $response->assertJsonValidationErrorFor('checklist.form.items.0.params.collapsed');
        $response->assertJsonValidationErrorFor('checklist.form.items.0.items.0.uuid');
        $response->assertJsonValidationErrorFor('checklist.form.items.0.items.0.title');
        $response->assertJsonValidationErrorFor('checklist.form.items.0.items.0.type');
        $response->assertJsonValidationErrorFor('checklist.form.items.0.items.0.required');
    }

    public function test_saving_valid_data()
    {
        $data = [
            'checklist' => [
                'checklist_title' => 'Test task form',
                'checklist_description' => 'A form example for the test task',
                'form' => [
                    'uuid' => '86d25d21-539a-4472-ac74-823c85eea236',
                    'type' => 'form',
                    'items' => [
                        [
                            'title' => 'Page 1',
                            'uuid' => '2dd886b4-581f-43bb-addc-e79bd66ce382',
                            'type' => 'page',
                            'items' => [
                                [
                                    'uuid' => 'd4f0a2f5-9ff3-40fc-97e0-14d22e52d3c6',
                                    'title' => 'question 1',
                                    'image_id' => null,
                                    'type' => 'question',
                                    'response_type' => 'list',
                                    'required' => false,
                                    'params' => [
                                        'response_set' => '1bf277e2-79fc-4d38-81b5-ca3c8ecbbb9d',
                                        'multiple_selection' => false,
                                    ],
                                    'check_conditions_for' => [
                                    ],
                                    'categories' => [
                                    ],
                                    'negative' => false,
                                    'notes_allowed' => true,
                                    'photos_allowed' => true,
                                    'issues_allowed' => true,
                                    'responded' => false,
                                ],
                                [
                                    'title' => 'section 1',
                                    'uuid' => 'b10081c9-c953-4001-9914-e0557e193f29',
                                    'type' => 'section',
                                    'repeat' => false,
                                    'weight' => 1,
                                    'required' => false,
                                    'items' => [
                                        [
                                            'uuid' => '4a9b3c49-7678-4743-94f3-2d246f59361e',
                                            'title' => 'question 2',
                                            'image_id' => null,
                                            'type' => 'question',
                                            'response_type' => 'list',
                                            'required' => false,
                                            'params' => [
                                                'response_set' => '1bf277e2-79fc-4d38-81b5-ca3c8ecbbb9d',
                                                'multiple_selection' => false,
                                            ],
                                            'check_conditions_for' => [
                                            ],
                                            'categories' => [
                                            ],
                                            'negative' => false,
                                            'notes_allowed' => true,
                                            'photos_allowed' => true,
                                            'issues_allowed' => true,
                                            'responded' => false,
                                        ],
                                        [
                                            'uuid' => '00331d70-b55a-49ed-b033-bb969c1ab79c',
                                            'title' => 'question 3',
                                            'image_id' => null,
                                            'type' => 'question',
                                            'response_type' => 'list',
                                            'required' => false,
                                            'params' => [
                                                'response_set' => '1bf277e2-79fc-4d38-81b5-ca3c8ecbbb9d',
                                                'multiple_selection' => false,
                                            ],
                                            'check_conditions_for' => [
                                            ],
                                            'categories' => [
                                            ],
                                            'negative' => false,
                                            'notes_allowed' => true,
                                            'photos_allowed' => true,
                                            'issues_allowed' => true,
                                            'responded' => false,
                                        ],
                                        [
                                            'title' => 'section 2',
                                            'uuid' => '9a228880-5c0a-43b0-bdcd-57e748b197e0',
                                            'type' => 'section',
                                            'repeat' => false,
                                            'weight' => 1,
                                            'required' => false,
                                            'items' => [
                                                [
                                                    'uuid' => 'edc5f3e2-d039-47d7-97c7-0b13d92e6926',
                                                    'title' => 'question 4',
                                                    'image_id' => null,
                                                    'type' => 'question',
                                                    'response_type' => 'list',
                                                    'required' => false,
                                                    'params' => [
                                                        'response_set' => '1bf277e2-79fc-4d38-81b5-ca3c8ecbbb9d',
                                                        'multiple_selection' => false,
                                                    ],
                                                    'check_conditions_for' => [
                                                    ],
                                                    'categories' => [
                                                    ],
                                                    'negative' => false,
                                                    'notes_allowed' => true,
                                                    'photos_allowed' => true,
                                                    'issues_allowed' => true,
                                                    'responded' => false,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'uuid' => '9d7f581f-1942-404e-b77e-e9f147d96ff7',
                                    'title' => 'question 5',
                                    'image_id' => null,
                                    'type' => 'question',
                                    'response_type' => 'list',
                                    'required' => false,
                                    'params' => [
                                        'response_set' => '1bf277e2-79fc-4d38-81b5-ca3c8ecbbb9d',
                                        'multiple_selection' => false,
                                    ],
                                    'check_conditions_for' => [
                                    ],
                                    'categories' => [
                                    ],
                                    'negative' => false,
                                    'notes_allowed' => true,
                                    'photos_allowed' => true,
                                    'issues_allowed' => true,
                                    'responded' => false,
                                ],
                                [
                                    'title' => 'section 3',
                                    'uuid' => 'b4695ada-6e05-4425-a361-1133796c165e',
                                    'type' => 'section',
                                    'repeat' => false,
                                    'weight' => 1,
                                    'required' => false,
                                    'items' => [
                                        [
                                            'uuid' => '19b7e5de-8eda-44ba-a75c-5eadedf9921b',
                                            'title' => 'question 6',
                                            'image_id' => null,
                                            'type' => 'question',
                                            'response_type' => 'list',
                                            'required' => false,
                                            'params' => [
                                                'response_set' => '1bf277e2-79fc-4d38-81b5-ca3c8ecbbb9d',
                                                'multiple_selection' => false,
                                            ],
                                            'check_conditions_for' => [
                                            ],
                                            'categories' => [
                                            ],
                                            'negative' => false,
                                            'notes_allowed' => true,
                                            'photos_allowed' => true,
                                            'issues_allowed' => true,
                                            'responded' => false,
                                        ],
                                    ],
                                ],
                            ],
                            'params' => [
                                'collapsed' => false,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $response = $this->postJson('/api/form', $data)->assertCreated();

        $this->assertDatabaseHas('checklists', [
            'title' => 'Test task form',
            'description' => 'A form example for the test task',
        ]);

        $this->assertDatabaseHas('forms', [
            'uuid' => '86d25d21-539a-4472-ac74-823c85eea236',
            'checklist_id' => $response->json('data.id'),
        ]);

        $this->assertDatabaseHas('pages', [
            'title' => 'Page 1',
        ]);

        $this->assertDatabaseHas('page_items', [
            'title' => 'question 1',
            'parent_id' => null,
        ]);

        $this->assertDatabaseHas('page_items', [
            'title' => 'section 1',
            'parent_id' => null,
        ]);
    }

    public function test_checklist_show()
    {
        /** @var Checklist $checklist */
        $checklist = Checklist::factory()
            ->has(
                Form::factory()
                    ->has(
                        Page::factory(2)
                            ->has(
                                PageItem::factory()
                                    ->state([
                                        'type' => PageItemType::SECTION,
                                    ])
                                    ->has(
                                        PageItem::factory(3)
                                            ->state([
                                                'type' => PageItemType::QUESTION,
                                            ]),
                                        'items'
                                    ),
                                'items'
                            ),
                        'pages'
                    ),
                'form'
            )
            ->createOne();

        $checklist->loadMissing(['form.pages.allItems']);

        $this->get("/api/form/{$checklist->id}")
            ->assertOk()
            ->assertJsonCount(3, 'data.form.items.0.items.0.items')
            ->assertJson([
                'data' => [
                    'checklist_title' => $checklist->title,
                    'checklist_description' => $checklist->description,
                    'form' => [
                        'uuid' => $checklist->form->uuid,
                        'type' => 'form',
                        'items' => [
                            [
                                'title' => $checklist->form->pages[0]->title,
                                'uuid' => $checklist->form->pages[0]->uuid,
                                'type' => 'page',
                                'items' => [
                                    [
                                        'title' => $checklist->form->pages[0]->items[0]->title,
                                        'uuid' => $checklist->form->pages[0]->items[0]->uuid,
                                        'type' => 'section',
                                        'repeat' => $checklist->form->pages[0]->items[0]->is_repeat,
                                        'weight' => $checklist->form->pages[0]->items[0]->weight,
                                        'required' => $checklist->form->pages[0]->items[0]->is_required,
                                        'items' => [
                                            [
                                                'uuid' => $checklist->form->pages[0]->items[0]->items[0]->uuid,
                                                'title' => $checklist->form->pages[0]->items[0]->items[0]->title,
                                                'image_id' => $checklist->form->pages[0]->items[0]->items[0]->image_id,
                                                'type' => 'question',
                                                'response_type' => $checklist->form->pages[0]->items[0]->items[0]->response_type,
                                                'required' => $checklist->form->pages[0]->items[0]->items[0]->is_required,
                                                'params' => [
                                                    'response_set' => $checklist->form->pages[0]->items[0]->items[0]->response_set,
                                                    'multiple_selection' => $checklist->form->pages[0]->items[0]->items[0]->multiple_selection,
                                                ],
                                                'check_conditions_for' => $checklist->form->pages[0]->items[0]->items[0]->check_conditions_for,
                                                'categories' => $checklist->form->pages[0]->items[0]->items[0]->categories,
                                                'negative' => $checklist->form->pages[0]->items[0]->items[0]->is_negative,
                                                'notes_allowed' => $checklist->form->pages[0]->items[0]->items[0]->is_notes_allowed,
                                                'photos_allowed' => $checklist->form->pages[0]->items[0]->items[0]->is_photos_allowed,
                                                'issues_allowed' => $checklist->form->pages[0]->items[0]->items[0]->is_issues_allowed,
                                                'responded' => $checklist->form->pages[0]->items[0]->items[0]->is_responded,
                                            ],
                                            [
                                                'uuid' => $checklist->form->pages[0]->items[0]->items[1]->uuid,
                                                'title' => $checklist->form->pages[0]->items[0]->items[1]->title,
                                                'image_id' => $checklist->form->pages[0]->items[0]->items[1]->image_id,
                                                'type' => 'question',
                                                'response_type' => $checklist->form->pages[0]->items[0]->items[1]->response_type,
                                                'required' => $checklist->form->pages[0]->items[0]->items[1]->is_required,
                                                'params' => [
                                                    'response_set' => $checklist->form->pages[0]->items[0]->items[1]->response_set,
                                                    'multiple_selection' => $checklist->form->pages[0]->items[0]->items[1]->multiple_selection,
                                                ],
                                                'check_conditions_for' => $checklist->form->pages[0]->items[0]->items[1]->check_conditions_for,
                                                'categories' => $checklist->form->pages[0]->items[0]->items[1]->categories,
                                                'negative' => $checklist->form->pages[0]->items[0]->items[1]->is_negative,
                                                'notes_allowed' => $checklist->form->pages[0]->items[0]->items[1]->is_notes_allowed,
                                                'photos_allowed' => $checklist->form->pages[0]->items[0]->items[1]->is_photos_allowed,
                                                'issues_allowed' => $checklist->form->pages[0]->items[0]->items[1]->is_issues_allowed,
                                                'responded' => $checklist->form->pages[0]->items[0]->items[1]->is_responded,
                                            ],
                                            [
                                                'uuid' => $checklist->form->pages[0]->items[0]->items[2]->uuid,
                                                'title' => $checklist->form->pages[0]->items[0]->items[2]->title,
                                                'image_id' => $checklist->form->pages[0]->items[0]->items[2]->image_id,
                                                'type' => 'question',
                                                'response_type' => $checklist->form->pages[0]->items[0]->items[2]->response_type,
                                                'required' => $checklist->form->pages[0]->items[0]->items[2]->is_required,
                                                'params' => [
                                                    'response_set' => $checklist->form->pages[0]->items[0]->items[2]->response_set,
                                                    'multiple_selection' => $checklist->form->pages[0]->items[0]->items[2]->multiple_selection,
                                                ],
                                                'check_conditions_for' => $checklist->form->pages[0]->items[0]->items[2]->check_conditions_for,
                                                'categories' => $checklist->form->pages[0]->items[0]->items[2]->categories,
                                                'negative' => $checklist->form->pages[0]->items[0]->items[2]->is_negative,
                                                'notes_allowed' => $checklist->form->pages[0]->items[0]->items[2]->is_notes_allowed,
                                                'photos_allowed' => $checklist->form->pages[0]->items[0]->items[2]->is_photos_allowed,
                                                'issues_allowed' => $checklist->form->pages[0]->items[0]->items[2]->is_issues_allowed,
                                                'responded' => $checklist->form->pages[0]->items[0]->items[2]->is_responded,
                                            ],
                                        ]
                                    ],
                                ]
                            ],
                            [
                                'title' => $checklist->form->pages[1]->title,
                                'uuid' => $checklist->form->pages[1]->uuid,
                                'type' => 'page',
                                'items' => [
                                    [
                                        'title' => $checklist->form->pages[1]->items[0]->title,
                                        'uuid' => $checklist->form->pages[1]->items[0]->uuid,
                                        'type' => 'section',
                                        'repeat' => $checklist->form->pages[1]->items[0]->is_repeat,
                                        'weight' => $checklist->form->pages[1]->items[0]->weight,
                                        'required' => $checklist->form->pages[1]->items[0]->is_required,
                                        'items' => [
                                            [
                                                'uuid' => $checklist->form->pages[1]->items[0]->items[0]->uuid,
                                                'title' => $checklist->form->pages[1]->items[0]->items[0]->title,
                                                'image_id' => $checklist->form->pages[1]->items[0]->items[0]->image_id,
                                                'type' => 'question',
                                                'response_type' => $checklist->form->pages[1]->items[0]->items[0]->response_type,
                                                'required' => $checklist->form->pages[1]->items[0]->items[0]->is_required,
                                                'params' => [
                                                    'response_set' => $checklist->form->pages[1]->items[0]->items[0]->response_set,
                                                    'multiple_selection' => $checklist->form->pages[1]->items[0]->items[0]->multiple_selection,
                                                ],
                                                'check_conditions_for' => $checklist->form->pages[1]->items[0]->items[0]->check_conditions_for,
                                                'categories' => $checklist->form->pages[1]->items[0]->items[0]->categories,
                                                'negative' => $checklist->form->pages[1]->items[0]->items[0]->is_negative,
                                                'notes_allowed' => $checklist->form->pages[1]->items[0]->items[0]->is_notes_allowed,
                                                'photos_allowed' => $checklist->form->pages[1]->items[0]->items[0]->is_photos_allowed,
                                                'issues_allowed' => $checklist->form->pages[1]->items[0]->items[0]->is_issues_allowed,
                                                'responded' => $checklist->form->pages[1]->items[0]->items[0]->is_responded,
                                            ],
                                            [
                                                'uuid' => $checklist->form->pages[1]->items[0]->items[1]->uuid,
                                                'title' => $checklist->form->pages[1]->items[0]->items[1]->title,
                                                'image_id' => $checklist->form->pages[1]->items[0]->items[1]->image_id,
                                                'type' => 'question',
                                                'response_type' => $checklist->form->pages[1]->items[0]->items[1]->response_type,
                                                'required' => $checklist->form->pages[1]->items[0]->items[1]->is_required,
                                                'params' => [
                                                    'response_set' => $checklist->form->pages[1]->items[0]->items[1]->response_set,
                                                    'multiple_selection' => $checklist->form->pages[1]->items[0]->items[1]->multiple_selection,
                                                ],
                                                'check_conditions_for' => $checklist->form->pages[1]->items[0]->items[1]->check_conditions_for,
                                                'categories' => $checklist->form->pages[1]->items[0]->items[1]->categories,
                                                'negative' => $checklist->form->pages[1]->items[0]->items[1]->is_negative,
                                                'notes_allowed' => $checklist->form->pages[1]->items[0]->items[1]->is_notes_allowed,
                                                'photos_allowed' => $checklist->form->pages[1]->items[0]->items[1]->is_photos_allowed,
                                                'issues_allowed' => $checklist->form->pages[1]->items[0]->items[1]->is_issues_allowed,
                                                'responded' => $checklist->form->pages[1]->items[0]->items[1]->is_responded,
                                            ],
                                            [
                                                'uuid' => $checklist->form->pages[1]->items[0]->items[2]->uuid,
                                                'title' => $checklist->form->pages[1]->items[0]->items[2]->title,
                                                'image_id' => $checklist->form->pages[1]->items[0]->items[2]->image_id,
                                                'type' => 'question',
                                                'response_type' => $checklist->form->pages[1]->items[0]->items[2]->response_type,
                                                'required' => $checklist->form->pages[1]->items[0]->items[2]->is_required,
                                                'params' => [
                                                    'response_set' => $checklist->form->pages[1]->items[0]->items[2]->response_set,
                                                    'multiple_selection' => $checklist->form->pages[1]->items[0]->items[2]->multiple_selection,
                                                ],
                                                'check_conditions_for' => $checklist->form->pages[1]->items[0]->items[2]->check_conditions_for,
                                                'categories' => $checklist->form->pages[1]->items[0]->items[2]->categories,
                                                'negative' => $checklist->form->pages[1]->items[0]->items[2]->is_negative,
                                                'notes_allowed' => $checklist->form->pages[1]->items[0]->items[2]->is_notes_allowed,
                                                'photos_allowed' => $checklist->form->pages[1]->items[0]->items[2]->is_photos_allowed,
                                                'issues_allowed' => $checklist->form->pages[1]->items[0]->items[2]->is_issues_allowed,
                                                'responded' => $checklist->form->pages[1]->items[0]->items[2]->is_responded,
                                            ],
                                        ]
                                    ],
                                ]
                            ],
                        ]
                    ]
                ]
            ]);
    }

    public function test_checklist_save_answers()
    {
        /** @var Checklist $checklist */
        $checklist = Checklist::factory()
            ->has(
                Form::factory()
                    ->has(
                        Page::factory(2)
                            ->has(
                                PageItem::factory()
                                    ->state([
                                        'type' => PageItemType::SECTION,
                                    ])
                                    ->has(
                                        PageItem::factory(3)
                                            ->state(fn(array $attributes, PageItem $parent) => [
                                                'type' => PageItemType::QUESTION,
                                                'page_id' => $parent->page_id,
                                            ]),
                                        'items'
                                    ),
                                'items'
                            ),
                        'pages'
                    ),
                'form'
            )
            ->createOne();

        $checklist->load(['form.pages.allItems']);

        $answers = [];

        $questions = PageItem::query()
            ->where('type', PageItemType::QUESTION)
            ->whereRelation('page.form', 'checklist_id', $checklist->id)
            ->get();

        /** @var PageItem $question */
        foreach ($questions as $question) {
            $answers[] = [
                'uuid' => $question->uuid,
                'answer' => "Answer to $question->id",
            ];
        }

        $this->postJson('/api/questionnaire', [
            'checklist_id' => $checklist->id,
            'answers' => $answers,
        ])->assertOk();

        foreach ($questions as $question) {
            $this->assertDatabaseMissing('page_items', [
                'id' => $question->id,
                'value' => null,
            ]);
        }
    }

    public function test_checklist_save_answers_of_sections()
    {
        /** @var Checklist $checklist */
        $checklist = Checklist::factory()
            ->has(
                Form::factory()
                    ->has(
                        Page::factory(2)
                            ->has(
                                PageItem::factory()
                                    ->state([
                                        'type' => PageItemType::SECTION,
                                    ])
                                    ->has(
                                        PageItem::factory(3)
                                            ->state(fn(array $attributes, PageItem $parent) => [
                                                'type' => PageItemType::QUESTION,
                                                'page_id' => $parent->page_id,
                                            ]),
                                        'items'
                                    ),
                                'items'
                            ),
                        'pages'
                    ),
                'form'
            )
            ->createOne();

        $checklist->load(['form.pages.allItems']);

        $answers = [];

        $questions = PageItem::query()
            ->whereRelation('page.form', 'checklist_id', $checklist->id)
            ->get();

        /** @var PageItem $question */
        foreach ($questions as $question) {
            $answers[] = [
                'uuid' => $question->uuid,
                'answer' => "Answer to $question->id",
            ];
        }

        $this->postJson('/api/questionnaire', [
            'checklist_id' => $checklist->id,
            'answers' => $answers,
        ])->assertUnprocessable()
            ->assertJsonValidationErrorFor('answers.0.uuid')
            ->assertJsonValidationErrorFor('answers.4.uuid');
    }

    public function test_checklist_save_answers_of_other_checklist()
    {
        /** @var Checklist $checklistA */
        $checklistA = Checklist::factory()
            ->has(
                Form::factory()
                    ->has(
                        Page::factory(2)
                            ->has(
                                PageItem::factory()
                                    ->state([
                                        'type' => PageItemType::SECTION,
                                    ])
                                    ->has(
                                        PageItem::factory(3)
                                            ->state(fn(array $attributes, PageItem $parent) => [
                                                'type' => PageItemType::QUESTION,
                                                'page_id' => $parent->page_id,
                                            ]),
                                        'items'
                                    ),
                                'items'
                            ),
                        'pages'
                    ),
                'form'
            )
            ->createOne();

        /** @var Checklist $checklistB */
        $checklistB = Checklist::factory()
            ->has(
                Form::factory()
                    ->has(
                        Page::factory(2)
                            ->has(
                                PageItem::factory()
                                    ->state([
                                        'type' => PageItemType::SECTION,
                                    ])
                                    ->has(
                                        PageItem::factory(3)
                                            ->state(fn(array $attributes, PageItem $parent) => [
                                                'type' => PageItemType::QUESTION,
                                                'page_id' => $parent->page_id,
                                            ]),
                                        'items'
                                    ),
                                'items'
                            ),
                        'pages'
                    ),
                'form'
            )
            ->createOne();

        $checklistA->load(['form.pages.allItems']);
        $checklistB->load(['form.pages.allItems']);

        $answers = [];

        $questions = PageItem::query()
            ->where('type', PageItemType::QUESTION)
            ->get();

        /** @var PageItem $question */
        foreach ($questions as $question) {
            $answers[] = [
                'uuid' => $question->uuid,
                'answer' => "Answer to $question->id",
            ];
        }

        $this->postJson('/api/questionnaire', [
            'checklist_id' => $checklistA->id,
            'answers' => $answers,
        ])->assertOk();

        $checklistAQuestionsAnsweredCount = PageItem::query()
            ->where('type', PageItemType::QUESTION)
            ->whereRelation('page.form', 'checklist_id', $checklistA->id)
            ->whereNotNull('value')
            ->count();

        $checklistBQuestionsAnsweredCount = PageItem::query()
            ->where('type', PageItemType::QUESTION)
            ->whereRelation('page.form', 'checklist_id', $checklistB->id)
            ->whereNotNull('value')
            ->count();

        $this->assertGreaterThan(0, $checklistAQuestionsAnsweredCount);
        $this->assertEquals(0, $checklistBQuestionsAnsweredCount);
    }
}
