<?php

namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class CheckboxM extends FormField 
{
    protected function getTemplate()
    {
        return 'vendor.laravel-form-builder.checkbox-m';
    }

    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $options['somedata'] = 'This is some data for view';

        return parent::render($options, $showLabel, $showField, $showError);
    }
}
