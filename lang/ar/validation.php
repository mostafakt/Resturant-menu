<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما :other يكون :value.',
    'active_url' => ':attribute ليس عنوان URL صالح.',
    'after' => ':attribute يجب أن يكون تاريخًا بعد :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخًا بعد أو مساويًا لـ :date.',
    'alpha' => ':attribute يجب أن يحتوي على أحرف فقط.',
    'alpha_dash' => ':attribute يجب أن يحتوي على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num' => ':attribute يجب أن يحتوي على أحرف وأرقام فقط.',
    'array' => ':attribute يجب أن يكون مصفوفة.',
    'before' => ':attribute يجب أن يكون تاريخًا قبل :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخًا قبل أو مساويًا لـ :date.',
    'between' => [
        'array' => ':attribute يجب أن يحتوي على بين :min و :max عنصرًا.',
        'file' => ':attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون بين :min و :max.',
        'string' => ':attribute يجب أن يكون بين :min و :max حرفًا.',
    ],
    'boolean' => 'حقل :attribute يجب أن يكون صحيحًا أو خاطئًا.',
    'confirmed' => 'تأكيد :attribute لا يتطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => ':attribute ليس تاريخًا صالحًا.',
    'date_equals' => ':attribute يجب أن يكون تاريخًا مساويًا لـ :date.',
    'date_format' => ':attribute لا يتطابق مع الصيغة :format.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما :other يكون :value.',
    'different' => ':attribute و :other يجب أن يكونا مختلفين.',
    'digits' => ':attribute يجب أن يحتوي على :digits أرقام.',
    'digits_between' => ':attribute يجب أن يكون بين :min و :max أرقام.',
    'dimensions' => ':attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'حقل :attribute يحتوي على قيمة مكررة.',
    'doesnt_end_with' => ':attribute قد لا ينتهي بأحد القيم التالية: :values.',
    'doesnt_start_with' => ':attribute قد لا يبدأ بأحد القيم التالية: :values.',
    'email' => ':attribute يجب أن يكون عنوان بريد إلكتروني صالحًا.',
    'ends_with' => ':attribute يجب أن ينتهي بأحد القيم التالية: :values.',
    'enum' => 'القيمة المحددة لـ :attribute غير صالحة.',
    'exists' => ':attribute المحدد غير صالح.',
    'file' => ':attribute يجب أن يكون ملفًا.',
    'filled' => 'حقل :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'array' => ':attribute يجب أن يحتوي على أكثر من :value عنصر.',
        'file' => ':attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أكبر من :value.',
        'string' => ':attribute يجب أن يكون أكبر من :value حرفًا.',
    ],
    'gte' => [
        'array' => ':attribute يجب أن يحتوي على :value عنصرًا أو أكثر.',
        'file' => ':attribute يجب أن يكون أكبر من أو مساويًا لـ :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أكبر من أو مساويًا لـ :value.',
        'string' => ':attribute يجب أن يكون أكبر من أو مساويًا لـ :value حرفًا.',
    ],
    'image' => ':attribute يجب أن يكون صورة.',
    'in' => ':attribute المحدد غير صالح.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => ':attribute يجب أن يكون عددًا صحيحًا.',
    'ip' => ':attribute يجب أن يكون عنوان IP صالحًا.',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صالحًا.',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صالحًا.',
    'json' => ':attribute يجب أن يكون سلسلة JSON صالحة.',
    'lowercase' => ':attribute يجب أن يكون بأحرف صغيرة.',
    'lt' => [
        'array' => ':attribute يجب أن يحتوي على أقل من :value عنصر.',
        'file' => ':attribute يجب أن يكون أقل من :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أقل من :value.',
        'string' => ':attribute يجب أن يكون أقل من :value حرفًا.',
    ],
    'lte' => [
        'array' => ':attribute لا يجب أن يحتوي على أكثر من :value عنصر.',
        'file' => ':attribute يجب أن يكون أقل من أو مساويًا لـ :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أقل من أو مساويًا لـ :value.',
        'string' => ':attribute يجب أن يكون أقل من أو مساويًا لـ :value حرفًا.',
    ],
    'mac_address' => ':attribute يجب أن يكون عنوان MAC صالحًا.',
    'max' => [
        'array' => ':attribute لا يجب أن يحتوي على أكثر من :max عنصر.',
        'file' => ':attribute لا يجب أن يكون أكبر من :max كيلوبايت.',
        'numeric' => ':attribute لا يجب أن يكون أكبر من :max.',
        'string' => ':attribute لا يجب أن يكون أكبر من :max حرفًا.',
    ],
    'max_digits' => ':attribute لا يجب أن يحتوي على أكثر من :max رقمًا.',
    'mimes' => ':attribute يجب أن يكون ملفًا من النوع: :values.',
    'mimetypes' => ':attribute يجب أن يكون ملفًا من النوع: :values.',
    'min' => [
        'array' => ':attribute يجب أن يحتوي على ما لا يقل عن :min عنصر.',
        'file' => ':attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون على الأقل :min.',
        'string' => ':attribute يجب أن يكون على الأقل :min حرفًا.',
    ],
    'min_digits' => ':attribute يجب أن يحتوي على ما لا يقل عن :min رقمًا.',
    'multiple_of' => ':attribute يجب أن يكون مضاعفًا للقيمة :value.',
    'not_in' => ':attribute المحدد غير صالح.',
    'not_regex' => 'تنسيق :attribute غير صالح.',
    'numeric' => ':attribute يجب أن يكون رقمًا.',
    'password' => [
        'letters' => ':attribute يجب أن يحتوي على ما لا يقل عن حرف واحد.',
        'mixed' => ':attribute يجب أن يحتوي على حرف واحد على الأقل من الحروف الكبيرة والحروف الصغيرة.',
        'numbers' => ':attribute يجب أن يحتوي على ما لا يقل عن رقم واحد.',
        'symbols' => ':attribute يجب أن يحتوي على ما لا يقل عن رمز واحد.',
        'uncompromised' => ':attribute المُعطى ظهر في تسرب بيانات. يرجى اختيار :attribute مختلفًا.',
    ],
    'present' => 'حقل :attribute يجب أن يكون موجودًا.',
    'prohibited' => 'حقل :attribute ممنوع.',
    'prohibited_if' => 'حقل :attribute ممنوع عندما :other يكون :value.',
    'prohibited_unless' => 'حقل :attribute ممنوع ما لم يكن :other في :values.',
    'prohibits' => 'حقل :attribute يمنع :other من التواجد.',
    'regex' => 'تنسيق :attribute غير صالح.',
    'required' => 'حقل :attribute مطلوب.',
    'required_array_keys' => 'حقل :attribute يجب أن يحتوي على مفاتيح للقيم التالية: :values.',
    'required_if' => 'حقل :attribute مطلوب عندما :other يكون :value.',
    'required_if_accepted' => 'حقل :attribute مطلوب عندما يتم قبول :other.',
    'required_unless' => 'حقل :attribute مطلوب ما لم يكن :other',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
