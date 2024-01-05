<?php

return [
    'unauthorized' => 'This action is unauthorized.',
    'model_not_found' => ':model not found!',

    'discount_code' => [
        'invalid' => 'invalid discount code',
        'code_active' => 'this code already active',
        'not_enough_points' => 'you dont have enough of points',


    ],

    'order_note' => [
        'fixed' => 'can\'t updated or deleted fixed the note',
    ],

    'order' => [
        'area' => [
            'exist' => 'the area not available in our system yet',
            'active' => 'the area not active right now',
            'exist_or_active' => 'the area not available in our system yet or not active right now',
        ],
        'driver' => [
            'accept' => 'can not accept order.',
            'reject' => 'can not reject order.',
            'belong' => 'this order not belong to your driver.',
            'emergency' => 'The order cannot be placed as an emergency.',
            'rout_product' => 'The order cannot be placed as an in rout to product.',
            'complete' => 'The order cannot be placed as an complete.',
            'pickup_product' => 'The order cannot be placed as an pickup products.',
            'take' => 'don\'t have many or you are offline.',
            'status' => 'order not in searching for driver.',
        ],
        'client' => [
            'selected_store' => 'the selected store is closed.'
        ],
        'time' => 'You have exceeded the time allowed to accept the order.',
        'public_service' => 'Order creation is currently disabled. Please contact customer support for assistance.'

    ],
    'payments' => [
        'confirm' => [
            'not_auth' => 'this payment not belong for you',
        ]
    ],
    'product' => [
        'store' => [
            'not_found' => 'product not found in this store'
        ],
        'unit' => 'product not sold by unit'
    ],
    'client' => [
        'city' => 'you not belong to any city'
    ],

    'auth' => [
        'banned' => 'your account is banned'
    ],
];
