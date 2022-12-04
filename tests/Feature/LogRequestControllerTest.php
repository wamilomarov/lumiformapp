<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LogRequestControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_saving_analytics()
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

        $this->postJson('/api/form', $data)->assertUnprocessable();

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

        $id = $response->json('data.id');

        $this->get("/api/form/$id");

        $this->assertDatabaseHas('request_logs', [
            'endpoint' => 'api/form',
            'method' => 'POST',
            'count' => 2,
        ]);

        $this->assertDatabaseHas('request_logs', [
            'endpoint' => "api/form/$id",
            'method' => 'GET',
            'count' => 1,
        ]);
    }
}
