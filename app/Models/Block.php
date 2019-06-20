<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Block extends Model
{
    use SoftDeletes;
    use NodeTrait;

    public $guarded = [];

    protected $hidden = [
        'deleted_at',
    ];
    
    public $columns = [
    	[
            'name' => 'column',
            'type' => 'tinyInteger',
            'database' => 'nullable',
            'rule' => 'required',
            'help' => 'Default value is 12, and each row has 12 columns',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'widget_type',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'required|in:
            	menu,
            	header,
            	slider,
            	featurs,
            	counting,
            	products,
            	content,
            	video,
            	pricing,
            	feedback,
            	team,
            	partners,
            	subscribe,
            	map,
            	contact,
            	footer',
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
            'form_type' => 'entity',
            'class' => 'App\Models\Widget',
            'property' => 'title',
            'property_key' => 'id',
            'multiple' => false,
            'table' => true,
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
            'name' => 'theme',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'required',
            'help' => 'Default theme is CA.',
            'form_type' => '',
            'table' => true,
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
        
    public function getColumns()
    {
        return $this->columns;
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
