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

    'accepted' => 'The :spec must be accepted.',
    'active_url' => 'The :spec is not a valid URL.',
    'after' => 'The :spec must be a date after :date.',
    'after_or_equal' => 'The :spec must be a date after or equal to :date.',
    'alpha' => 'The :spec may only contain letters.',
    'alpha_dash' => 'The :spec may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :spec may only contain letters and numbers.',
    'array' => 'The :spec must be an array.',
    'before' => 'The :spec must be a date before :date.',
    'before_or_equal' => 'The :spec must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :spec must be between :min and :max.',
        'file' => 'The :spec must be between :min and :max kilobytes.',
        'string' => 'The :spec must be between :min and :max characters.',
        'array' => 'The :spec must have between :min and :max items.',
    ],
    'boolean' => 'The :spec field must be true or false.',
    'confirmed' => 'The :spec confirmation does not match.',
    'date' => 'The :spec is not a valid date.',
    'date_equals' => 'The :spec must be a date equal to :date.',
    'date_format' => 'The :spec does not match the format :format.',
    'different' => 'The :spec and :other must be different.',
    'digits' => 'The :spec must be :digits digits.',
    'digits_between' => 'The :spec must be between :min and :max digits.',
    'dimensions' => 'The :spec has invalid image dimensions.',
    'distinct' => 'The :spec field has a duplicate value.',
    'email' => 'The :spec must be a valid email address.',
    'exists' => 'The selected :spec is invalid.',
    'file' => 'The :spec must be a file.',
    'filled' => 'The :spec field must have a value.',
    'gt' => [
        'numeric' => 'The :spec must be greater than :value.',
        'file' => 'The :spec must be greater than :value kilobytes.',
        'string' => 'The :spec must be greater than :value characters.',
        'array' => 'The :spec must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :spec must be greater than or equal :value.',
        'file' => 'The :spec must be greater than or equal :value kilobytes.',
        'string' => 'The :spec must be greater than or equal :value characters.',
        'array' => 'The :spec must have :value items or more.',
    ],
    'image' => 'The :spec must be an image.',
    'in' => 'The selected :spec is invalid.',
    'in_array' => 'The :spec field does not exist in :other.',
    'integer' => 'The :spec must be an integer.',
    'ip' => 'The :spec must be a valid IP address.',
    'ipv4' => 'The :spec must be a valid IPv4 address.',
    'ipv6' => 'The :spec must be a valid IPv6 address.',
    'json' => 'The :spec must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :spec must be less than :value.',
        'file' => 'The :spec must be less than :value kilobytes.',
        'string' => 'The :spec must be less than :value characters.',
        'array' => 'The :spec must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :spec must be less than or equal :value.',
        'file' => 'The :spec must be less than or equal :value kilobytes.',
        'string' => 'The :spec must be less than or equal :value characters.',
        'array' => 'The :spec must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :spec may not be greater than :max.',
        'file' => 'The :spec may not be greater than :max kilobytes.',
        'string' => 'The :spec may not be greater than :max characters.',
        'array' => 'The :spec may not have more than :max items.',
    ],
    'mimes' => 'The :spec must be a file of type: :values.',
    'mimetypes' => 'The :spec must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :spec must be at least :min.',
        'file' => 'The :spec must be at least :min kilobytes.',
        'string' => 'The :spec must be at least :min characters.',
        'array' => 'The :spec must have at least :min items.',
    ],
    'not_in' => 'The selected :spec is invalid.',
    'not_regex' => 'The :spec format is invalid.',
    'numeric' => 'The :spec must be a number.',
    'present' => 'The :spec field must be present.',
    'regex' => 'The :spec format is invalid.',
    'required' => 'The :spec field is required.',
    'required_if' => 'The :spec field is required when :other is :value.',
    'required_unless' => 'The :spec field is required unless :other is in :values.',
    'required_with' => 'The :spec field is required when :values is present.',
    'required_with_all' => 'The :spec field is required when :values are present.',
    'required_without' => 'The :spec field is required when :values is not present.',
    'required_without_all' => 'The :spec field is required when none of :values are present.',
    'same' => 'The :spec and :other must match.',
    'size' => [
        'numeric' => 'The :spec must be :size.',
        'file' => 'The :spec must be :size kilobytes.',
        'string' => 'The :spec must be :size characters.',
        'array' => 'The :spec must contain :size items.',
    ],
    'starts_with' => 'The :spec must start with one of the following: :values',
    'string' => 'The :spec must be a string.',
    'timezone' => 'The :spec must be a valid zone.',
    'unique' => 'The :spec has already been taken.',
    'uploaded' => 'The :spec failed to upload.',
    'url' => 'The :spec format is invalid.',
    'uuid' => 'The :spec must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "spec.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given spec rule.
    |
    */

    'custom' => [
        'spec-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our spec placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
