<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use NodeTrait;
    use SoftDeletes;

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
            'database' => 'nullable',
            'rule' => 'required|max:80|regex:/^[a-z0-9-]+$/',
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
            'type' => 'tinyInteger',
            'database' => 'nullable',
            'rule' => 'required',
            'help' => '',
            'form_type' => 'enum',
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

    protected $guarded = [];

    protected $hidden = [
        'deleted_at',
    ];

    protected $appends = ['text'];

    public function getTextAttribute()
    {
        return $this->title;
    }

    public function getColumns()
    {
        return $this->columns;
    }
}
