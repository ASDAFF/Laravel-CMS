<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    use SoftDeletes;

    public $columns = [
        [
            'name' => 'widget_type',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'required',
                // in:
                // 	menu,
                // 	header,
                // 	slider,
                // 	featurs,
                // 	counting,
                // 	products,
                // 	content,
                // 	video,
                // 	pricing,
                // 	feedback,
                // 	team,
                // 	partners,
                // 	subscribe,
                // 	map,
                // 	contact,
                // 	footer,
            'help' => '',
            'form_type' => 'enum',
            'table' => true,
        ],
    	[
            'name' => 'widget_id',
            'type' => 'bigInteger',
            'database' => 'unsigned',
            'relation' => 'widgets',
            'rule' => 'numeric|exists:widgets,id',
            'help' => '',
            'form_type' => 'none', // 'entity',
            'class' => 'App\Models\Widget',
            'property' => 'title',
            'property_key' => 'id',
            'multiple' => false,
            'table' => false,
        ],
    	[
            'name' => 'page_id',
            'type' => 'bigInteger',
            'database' => 'unsigned',
            'relation' => 'pages',
            'rule' => 'numeric|exists:pages,id',
            'help' => '',
            'form_type' => 'entity',
            'class' => 'App\Models\Page',
            'property' => 'title',
            'property_key' => 'id',
            'multiple' => false,
            'table' => false,
        ],
        [
            'name' => 'page',
            'type' => 'string',
            'database' => 'none',
            'rule' => '',
            'help' => '',
            'form_type' => 'none',
            'table' => true,
        ],
        [
            'name' => 'theme',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'required',
            'help' => 'Default theme is CA.',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'order',
            'type' => 'integer',
            'database' => '',
            'rule' => 'numeric',
            'help' => 'Order of block, lower is on top',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'column',
            'type' => 'tinyInteger',
            'database' => 'nullable',
            'rule' => 'required',
            'help' => 'Default value is 12, and each row has 12 columns',
            'form_type' => '',
            'table' => false,
        ],
        [
            'name' => 'activated',
            'type' => 'boolean',
            'database' => 'default',
            'rule' => 'boolean',
            'help' => '',
            'form_type' => '', // switch-m
            'table' => false,
        ],
    ];

    protected $guarded = [];

    protected $hidden = [
        'deleted_at',
    ];

    public function getColumns()
    {
        return $this->columns;
    }

    public static function getStaticTypes()
    {
        return [
            'menu',
            'header',
            'content',
            'footer',
            'loading',
        ];
    }

    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'page_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('activated', 1);
    }
}
