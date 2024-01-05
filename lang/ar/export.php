<?php

return [
    'employe' => [
        'id' => 'الرقم المعرف',
        'firstName' => 'الاسم الأول',
        'lastName' => 'اسم العائلة',
        'status' =>  'حالة',
        'mobile' => 'رقم الجوال',
        'address' => 'العنوان',
        'roles' =>  'الأدوار',
        'createdAt' => 'تاريخ الإنشاء'
    ],

    'area' => [
        'name' => 'الاسم',
        'note' => 'ملاحظة',
        'status' => 'حالة',
        'city' => 'المدينة'
    ],

    'banner' => [
        'id' => 'الرقم المعرف',
        'text' => 'النص',
        'status' => 'حالة',
        'rateableType' => 'نوع ',
        'link' => 'الرابط'
    ],

    'category' => [
        'id' => 'الرقم المعرف',
        'name' => 'الاسم',
        'parent' => 'لاب',
        'order' => 'الطلب',
    ],

    'city' => [
        'name' => 'الاسم',
        'note' => 'ملاحظة'
    ],

    'client' => [
        'id' => 'الرقم المعرف',
        'firstName' => 'الاسم الأول',
        'lastName' => 'اسم العائلة',
        'city' => 'المدينة',
        'status' =>  'حالة',
        'mobile' => 'رقم الجوال',
        'createdAt' => 'تاريخ الإنشاء'
    ],

    'complaint' => [
        'id' => 'الرقم المعرف',
        'status' =>  'حالة',
        'type' => 'النوع',
        'title' => 'العنوان',
        'description' => 'وصف',
        'user' => 'المستخدم'
    ],

    'delivery' => [
        'id' => 'الرقم المعرف',
        'firstName' => 'الاسم الأول',
        'lastName' => 'اسم العائلة',
        'city' => 'المدينة',
        'status' =>  'حالة',
        'mobile' => 'رقم الجوال',
        'createdAt' => 'تاريخ الإنشاء',
        'statusWorker' => 'حالة العامل '
    ],

    'discountCode' => [
        'code' => 'الكود',
        'type' => 'النوع',
        'discount_code_value' =>  'قيمة الخصم',
        'status' =>  'حالة',
        'validity_date' =>  'تاريخ الصلاحية',
        'code_validity' => 'صلاحية الكود',
        'number_points' => 'عدد النقاط',
        'frequency_of_use' => 'الاستخدام'
    ],

    'generalNotification' => [
        'title' => 'العنوان',
        'slide' => 'شريحة',
        'note' => 'ملاحظة'
    ],

    'homepageListing' => [
        'id' => 'الرقم المعرف',
        'title' => 'العنوان',
        'type' => 'النوع',
        'status' => 'الحالة'
    ],

    'investor' => [
        'id' => 'الرقم المعرف ',
        'firstName' => 'الاسم الأول',
        'lastName' => 'اسم العائلة',
        'createdAt' => 'تاريخ الإنشاء',
        'status' =>  'حالة',
        'mobile' => 'رقم الجوال',
        'statusInvestor' => 'حالة الصيدلي',
        'type' => 'النوع',
        'store' =>  'الصيدلية'
    ],

    'orderNote' => [
        'text' => 'النص',
        'note' => 'ملاحظة',
    ],

    'product' => [
        'id' => 'الرقم المعرف ',
        'name' => 'الاسم',
        'extraName' => 'اسم إضافي',
        'mainCategory' => 'لصنف الرئيسي',
        'brand' => 'الماركة',
        'trademark' => 'علامة',
        'type' => 'النوع',
        'needRecipe' => 'الحاجة لراشيتة ',
        'soldByUnit' => 'يباع بالتجزئة',
        'status' => 'الحالة',
        'available' => 'متاح',
        'isNew' => 'جديد',
        'description' => 'توصيف',
        'note' => 'ملاحظة',
        'weighting' => 'الوزن',
        'watch' => 'عدد المشاهدات',
        'parentCategory' => 'الصنف الأب',
        'unit' => 'واحدة المنتح',
        'generalDiscount' => 'الحسم العام',
        'specialDiscount' => 'الحسم الخاص',
        'valueGeneralDiscount' => 'قيمة الحسم العام',
        'valueSpecialDiscount' => '  قيمة الحسم الخاص ',
        'createdAt' => 'تاريخ الانشاء',
    ],

    'role' => [
        'id' => 'الرقم المعرف',
        'name' => 'الاسم',
    ],

    'store' => [
        'id' => 'الرقم المعرف',
        'name' => 'الاسم',
        'city' => 'المدينة',
        'type' => 'النوع',
        'firstPhone' => 'رقم الهاتف',
        'status' => 'حالة',
        'workStatus' => 'حالة العمل',
        'createdAt' => 'تاريخ الانشاء',
        'pharmacyPromotion' => 'صيدلية مميزة'
    ],

    'trademark' => [
        'id' => 'الرقم المعرف',
        'name' => 'الاسم',
        'is_special' => 'خاص',
        'order' => 'الطلب',
        'note' => 'ملاحظة'
    ],
    'collectionPoint' => [
        'id' => 'الرقم المعرف',
        'name' =>  'الاسم',
        'status' => 'حالة',
        'debtValue' =>  'قيمة الدين ',
        'employ' =>  'الموظف',
        'city' => 'المدينة',
        'area' => 'المنطقة'
    ],
    'collectionPointPayment' => [
        'id' => 'الرقم المعرف',
        'employ' =>  'الموظف',
        'collectionPoint' =>  'نقاط التحصيل',
        'isConfirmed' => 'حالة الدفعة',
        'value' => 'القيمة',
        'receiptNumber' => 'رقم الإيصال	',
        'note' => 'ملاحظة',
        'createdAt' => 'تاريخ الانشاء '

    ],
    'order' => [
        'id' => 'الرقم المعرف',
        'client' => 'العميل',
        'driver' => 'عامل التوصيل',
        'type' => 'نوع مصدر الطلب',
        'store' => 'الصيدلية أوالمتجر',
        'status' => 'حالة الطلب الراهنة',
        'finalPrice' => 'القيمة الإجمالية',
        'isEmergency' => 'الطلب إسعافي',
        'isRecipe' => 'يحتاج إلى استلام الروشتة',
        'clientNote' => 'ملاحظات العميل',
        'note' => 'ملاحظة',
        'createdAt' => 'تاريخ الانشاء',
    ]

];
