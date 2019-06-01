<?php

return [
    'defaults'      => [
        'wrapper_class'       => 'form-group m-form__group',
        'wrapper_error_class' => 'has-error',
        'label_class'         => '',
        'field_class'         => 'form-control m-input m-input--air m-input--pill',
        'field_error_class'   => '',
        'help_block_class'    => 'm-form__help',
        'error_class'         => 'text-danger',
        'required_class'      => 'required',

        // Override a class from a field.
        //'text'                => [
        //    'wrapper_class'   => 'form-field-text',
        //    'label_class'     => 'form-field-text-label',
        //    'field_class'     => 'form-field-text-field',
        //]
        //'radio'               => [
        //    'choice_options'  => [
        //        'wrapper'     => ['class' => 'form-radio'],
        //        'label'       => ['class' => 'form-radio-label'],
        //        'field'       => ['class' => 'form-radio-field'],
        //],
    ],
    // Templates
    'form'          => 'laravel-form-builder::form',
    'text'          => 'laravel-form-builder::text',
    'textarea'      => 'laravel-form-builder::textarea',
    'button'        => 'laravel-form-builder::button',
    'buttongroup'   => 'laravel-form-builder::buttongroup',
    'radio'         => 'laravel-form-builder::radio',
    'checkbox'      => 'laravel-form-builder::checkbox-m',
    'select'        => 'laravel-form-builder::select',
    'choice'        => 'laravel-form-builder::choice',
    'repeated'      => 'laravel-form-builder::repeated',
    'child_form'    => 'laravel-form-builder::child_form',
    'collection'    => 'laravel-form-builder::collection',
    'static'        => 'laravel-form-builder::static',

    // Remove the laravel-form-builder:: prefix above when using template_prefix
    'template_prefix'   => '',

    'default_namespace' => '',

    'custom_fields' => [
        'switch-m'   => 'App\Forms\Fields\SwitchM',
        'checkbox-m' => '\App\Forms\Fields\CheckboxM',
        'switch-bootstrap-m' => '\App\Forms\Fields\SwitchBootstrapM',
        'text-m' => '\App\Forms\Fields\TextM',
        // 'ckeditor' => '\App\Forms\Fields\Ckeditor',
    ],
    
    'field_icons' => [
        'url' => 'la-sitemap',
        'title' => 'la-header',
        'keywords' => 'la-key',
        'meta_image' => 'la-image',
        'canonical_url' => 'la-globe',
        'meta_description' => 'la-bookmark',
        'email' => 'la-envelope-o',
        'first_name' => 'la-user',
        'last_name' => 'la-users',
        'mobile' => 'la-mobile-phone',
        'phone' => 'la-phone',
        'birth_date' => 'la-child',
        'website' => 'la-internet-explorer',
        'password' => 'la-lock',
        'password_confirmation' => 'la-unlock',
    ],
];
