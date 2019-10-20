<?php

namespace App\Models;

use App\Base\BaseModel;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends BaseModel
{
    use NodeTrait;

    // title, url, activated, location, parent_id
    public $columns = [
        [
            'name' => 'title',
            'type' => 'string',
            'database' => '',
            'rule' => 'required|max:60|min:2',
            'help' => 'Title should be minimum 2 and maximum 60 characters.',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'url',
            'type' => 'string',
            'database' => '',
            'rule' => 'required|max:80',
            'help' => 'Url should be unique, contain lowercase characters and numbers and -',
            'form_type' => '',
            'table' => true,
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
            'name' => 'location',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => 'enum',
            'form_enum_class' => 'MenuType',
            'table' => false,
        ],
        [
            'name' => 'parent_id',
            'type' => 'bigInteger',
            'database' => 'none',
            'relation' => 'menus',
            'rule' => 'nullable|exists:menus,id',
            'help' => '',
            'form_type' => 'none',
            'table' => true,
        ],
    ];

    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->title;
    }
}
