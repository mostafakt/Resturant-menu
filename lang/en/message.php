<?php

return [
    'otp' => [
        'title' => 'your verification code is',
    ],

    'order' => [
        'status' => [
            'title' => 'order changed status',
            'body' => 'your order number :id changed it status to :status',
        ],
        'select_driver' => [
            'title' => 'New Order',
            'body' => 'There is a new order you can check it during :driverTime minutes ',
        ],
        'select_investor' => [
            'title' => 'New Order',
            'body' => 'There is a new order you can check it  during :investorTime minutes ',
        ],
        'city_broadcast' => [
            'title' => 'new city broadcast ',
            'body' => ' there is a broadcast city new order u can check it',
        ],
        'area_broadcast' => [
            'title' => 'new area broadcast ',
            'body' => ' there is a broadcast area new order u can check it',
        ],
    ],
    'medicationPackage' => [
        'title' => 'activate the medication package',
        'body' => 'you can now activate the package :name',
    ],
    'driver' => [
        'payment' => [
            'title' => 'payment confirm',
            'body' => 'your payment id :id and its value  :value and the payment number :number',
        ],
        'emergency' => [
            'title' => "emergency request",
            'body' => 'There is order number :id changed it status to emergency',
        ]
    ],

    'new_message' => [
        'title' => 'new message',
        'body' => 'you have a new message',
    ],
];
