<?php

return [
    'employe' => [
        'id' => 'Id',
        'firstName' => 'First Name',
        'lastName' => 'Last Name',
        'status' =>  'Status',
        'mobile' => 'Mobile',
        'address' => 'Address',
        'roles' =>  'Roles',
        'createdAt' => 'Created At'
    ],

    'area' => [
        'name' => 'Name',
        'note' => 'Note',
        'status' => 'Status',
        'city' => 'City'
    ],

    'banner' => [
        'id' => 'Id',
        'text' => 'Text',
        'status' => 'Status',
        'rateableType' => 'Rateable Type',
        'link' => 'Link'
    ],

    'category' => [
        'id' => 'Id',
        'name' => 'Name',
        'parent' => 'Parent',
        'order' => 'Order',
    ],

    'city' => [
        'name' => 'Name',
        'note' => 'Note'
    ],

    'client' => [
        'id' => 'Id',
        'firstName' => 'First Name',
        'lastName' => 'Last Name',
        'city' => 'City',
        'status' =>  'Status',
        'mobile' => 'Mobile',
        'createdAt' => 'Created At'
    ],

    'complaint' => [
        'id' => 'Id',
        'status' =>  'Status',
        'type' => 'Type',
        'title' => 'Title',
        'description' => 'Description',
        'user' => 'User'
    ],

    'delivery' => [
        'id' => 'Id',
        'firstName' => 'First Name',
        'lastName' => 'Last Name',
        'city' => 'City',
        'status' =>  'Status',
        'mobile' => 'Mobile',
        'createdAt' => 'Created At',
        'statusWorker' => 'Status Worker'
    ],

    'discountCode' => [
        'code' => 'Code',
        'type' => 'Type',
        'discount_code_value' =>  'Discount Value',
        'status' =>  'Status',
        'validity_date' =>  'Validity Date ',
        'code_validity' => 'Code Validity ',
        'number_points' => 'Number Points',
        'frequency_of_use' => 'Frequency Of Use'
    ],

    'generalNotification' => [
        'title' => 'Title',
        'slide' => 'slice',
        'note' => 'Note'
    ],

    'homepageListing' => [
        'id' => ' Id',
        'title' => 'Title',
        'type' => 'Type',
        'status' => 'Status'
    ],

    'investor' => [
        'id' => 'Id ',
        'firstName' => ' First Name',
        'lastName' => 'Last Name ',
        'createdAt' => ' Created At',
        'status' =>  'Status',
        'mobile' => ' Mobile',
        'statusInvestor' => 'Status Investor ',
        'type' => 'Type',
        'store' =>  'Store'
    ],

    'orderNote' => [
        'text' => 'Text',
        'note' => 'Note',
    ],

    'product' => [
        'id' => 'Id',
        'name' => 'Name',
        'extraName' => 'Extra Name',
        'mainCategory' => 'Main Category',
        'brand' => ' Brand',
        'trademark' => 'Trademark ',
        'type' => 'Type',
        'needRecipe' => ' Need Recipe ',
        'soldByUnit' => 'Sold By Unit',
        'status' => 'Status',
        'available' => 'Available',
        'isNew' => 'Is New ',
        'description' => 'Description ',
        'note' => 'Note',
        'weighting' => 'Weighting ',
        'watch' => 'Watch',
        'parentCategory' => 'Parent Category',
        'unit' => 'Unit ',
        'generalDiscount' => 'General Discount',
        'specialDiscount' => 'Special Discount',
        'valueGeneralDiscount' => 'Value General Discount',
        'valueSpecialDiscount' => 'Value Special Discount',
        'createdAt' => 'Created At', 
    ],
    'role' => [
        'id' => 'Id',
        'name' => 'Name',
    ],

    'store' => [
        'id' => 'Id',
        'name' => 'Name',
        'city' => 'City',
        'type' => 'Type',
        'firstPhone' => ' First Phone',
        'status' => 'Status',
        'workStatus' => 'Work Status',
        'createdAt' => 'Created At',
        'pharmacyPromotion' => 'Pharmacy Promotion'
    ],

    'trademark' => [
        'id' => 'Id ',
        'name' => 'Name',
        'is_special' => 'Is Special',
        'order' => 'Order',
        'note' => 'Note'
    ],
    'collectionPoint' => [
        'id' => 'Id ',
        'name' =>  'Name',
        'status' => 'Status',
        'debtValue' =>  'Debt Value',
        'employ' =>  'Employ',
        'city' => 'City',
        'area' => 'Area'
    ],
    'collectionPointPayment' => [
        'id' => 'Id ',
        'employ' =>  'Employ',
        'collectionPoint' =>  'Collection Point',
        'isConfirmed' =>'isConfirmed',
        'value' =>' Value',
        'receiptNumber' => 'Receipt Number',
        'note' => 'Note',
        'createdAt' =>'Created At '

    ],
    'order' => [
        'id' => 'Id',
        'client' => 'Client',
        'driver' => ' Driver',
        'type' => 'Type',
        'store' => 'Store',
        'status' => 'Status',
        'finalPrice' => 'Final Price',
        'isEmergency' => 'Is Emergency',
        'isRecipe' => ' Is Recipe',
        'clientNote' => ' Client Note',
        'note' => 'Note',
        'createdAt' => 'Created At',
    ]
];
