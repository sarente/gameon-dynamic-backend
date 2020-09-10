<?php

return [
    'competence'   => [
        'type' => 'state_machine',
        'marking_store' => [
            'type' => 'method',
            'property'=> 'state'
        ],
        'supports' => [\App\Models\Activity::class],
        'places' => [
            'draft',
            'review',
            'rejected',
            'published'
        ],
        'transitions'   => [
            'to_review' => [
                'from' => 'draft',
                'to' => 'review'
            ],
            'publish' => [
                'from' => 'review',
                'to' => 'published'
            ],
            'reject' => [
                'from' => 'review',
                'to' => 'rejected'
            ]
        ],
    ]
];