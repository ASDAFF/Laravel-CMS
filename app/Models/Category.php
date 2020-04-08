<?php

namespace App\Models;

use App\Services\BaseModel;

class Category extends BaseModel
{
    public $columns = [
        [
            'name' => 'type',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'required',
            'help' => 'This category is for which models?',
            'form_type' => 'enum',
            'form_enum_class' => 'ModelType',
            'table' => true,
        ],
        ['name' => 'title'],
        ['name' => 'url'],
        ['name' => 'description'],
        ['name' => 'image'],
        ['name' => 'icon'],
        ['name' => 'activated'],
        ['name' => 'google_index'],
        ['name' => 'canonical_url'],
        ['name' => 'order'],
        [
            'name' => 'parent_id',
            'type' => 'unsignedBigInteger',
            'database' => 'nullable',
            'relation' => 'categories',
            'rule' => 'nullable|exists:categories,id',
            'help' => '',
            'form_type' => 'entity',
            'class' => Category::class,
            'property' => 'title',
            'property_key' => 'id',
            'multiple' => false,
            'table' => true,
        ],
        ['name' => 'language'],
    ];

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function models()
    {
        return $this->hasMany('App\\Models\\' . $this->type);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::updating(function($model){
            if($model->parent_id == $model->id){
                abort(500);
            }
        });
    }
}
