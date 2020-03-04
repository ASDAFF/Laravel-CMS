<?php

namespace App\Models;

use App\Services\BaseModel;

class Answer extends BaseModel
{
    public $columns = [
        ['name' => 'user_id'],
        ['name' => 'activated'],
        [
            'name' => 'form_id',
            'type' => 'unsignedBigInteger',
            'database' => 'nullable',
            'relation' => 'forms',
            'rule' => 'nullable',
            'help' => '',
            'form_type' => 'entity',
            'class' => 'App\Models\Form',
            'property' => 'title',
            'property_key' => 'id',
            'multiple' => false,
            'table' => true,
        ],
        [
            'name' => 'answers',
            'type' => 'text',
            'database' => 'nullable',
            'rule' => 'nullable',
            'help' => 'Dont change it, its encoded.',
            'form_type' => 'textarea',
            'table' => true,
        ],
        [
            'name' => 'created_at',
            'type' => 'string',
            'database' => 'none',
            'rule' => '',
            'help' => '',
            'form_type' => 'none',
            'table' => true,
        ],
    ];

    public function form()
    {
        return $this->belongsTo('App\Models\Form', 'form_id', 'id');
    }
}
