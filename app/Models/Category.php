<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    use SoftDeletes;

    public $guarded = [];

    protected $hidden = [
        'deleted_at',
    ];

    public $columns = [
        [
            'name' => 'title',
            'type' => 'string',
            'database' => '',
            'rule' => 'required|max:60|min:10',
            'help' => 'Title should be minimum 10 and maximum 60 characters.',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'url',
            'type' => 'string',
            'database' => '',
            'rule' => 'required|max:80|regex:/^[a-z0-9-]+$/',
            'help' => 'Url should be unique, contain lowercase characters and numbers and -',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'description',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable|max:191',
            'help' => 'Brief description about this category.',
            'form_type' => 'textarea',
            'table' => false,
        ],
        [
            'name' => 'meta_description',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'required|max:191|min:70',
            'help' => 'Meta description should have minimum 70 and maximum 191 characters.',
            'form_type' => 'textarea',
            'table' => false,
        ],
        [
            'name' => 'meta_image',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable|max:191|url',
            'help' => 'Meta image shows when this page is shared in social networks.',
            'form_type' => '',
            'table' => false,
        ],
        [
            'name' => 'activated',
            'type' => 'boolean',
            'database' => 'default',
            'rule' => 'boolean',
            'help' => '',
            'form_type' => '',
            'table' => false,
        ],
        [
            'name' => 'google_index',
            'type' => 'boolean',
            'database' => 'default',
            'rule' => 'boolean',
            'help' => 'Google will index this page.',
            'form_type' => 'checkbox',
            'table' => false,
        ],
        [
            'name' => 'canonical_url',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable|max:191|url',
            'help' => 'Canonical url just used for seo redirect duplicate contents.',
            'form_type' => '',
            'table' => false,
        ],
    ];

    public function getColumns()
    {
        return $this->columns;
    }
}
