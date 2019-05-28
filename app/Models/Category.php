<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Str;

// use Nestable\NestableTrait;

class Category extends Model
{
    use NodeTrait;
    use SoftDeletes;

	public $guarded = [];

	public $columns = [
        [
            'name' => 'title',
            'type' => 'string',
            'rule' => '',
            'validation' => 'required',
            'help' => '',
            'table' => true,
        ],
        [
            'name' => 'url',
            'type' => 'string',
            'rule' => 'unique',
            'validation' => 'required',
            'help' => 'Slug should be unique, contain lowercase characters and numbers and -',
            'table' => true,
        ],
        [
            'name' => 'description',
            'type' => 'string',
            'rule' => 'nullable',
            'validation' => 'nullable|max:191',
            'help' => 'Brif description about this category.',
            'form_type' => 'textarea',
            'table' => true,
        ],
        [
            'name' => 'meta_description',
            'type' => 'string',
            'rule' => 'nullable',
            'validation' => 'required|max:191|min:70',
            'help' => 'Meta description should have minimum 70 and maximum 191 characters.',
            'form_type' => 'textarea',
        ],
        [
            'name' => 'meta_image',
            'type' => 'string',
            'rule' => 'nullable',
            'validation' => 'nullable|max:191|url',
            'help' => 'Meta image shows when this page is shared in social networks.',
        ],
        [
            'name' => 'published',
            'type' => 'boolean',
            'rule' => 'default',
        ],
        [
            'name' => 'google_index',
            'type' => 'boolean',
            'rule' => 'default',
            'help' => 'Google will index this page.',
        ],
        [
            'name' => 'canonical_url',
            'type' => 'string',
            'rule' => 'nullable',
            'validation' => 'nullable|max:191|url',
            'help' => 'Canonical url just used for seo redirect duplicate contents.',
        ],
        [
            'name' => 'creator_id',
            'relation' => 'users',
        ],
        [
            'name' => 'editor_id',
            'relation' => 'users',
        ],
    ];

    public function getColumns()
    {
        return $this->columns;
    }

    public function editor()
    {
        return $this->belongsTo('App\Models\User', 'editor_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('published', true);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->url = $model->url ? $model->url : Str::kebab($model->title);
            $model->published = $model->published ? 1 : 0;
            $model->google_index = $model->google_index ? 1 : 0;
            $model->creator_id = Auth::id() ?: 1;
            $model->editor_id = Auth::id() ?: 1;
        });

        self::updating(function($model){
            $model->url = $model->url ? $model->url : Str::kebab($model->title);
            $model->published = $model->published ? 1 : 0;
            $model->google_index = $model->google_index ? 1 : 0;
            $model->editor_id = Auth::id() ?: 1;
        });
    }
}
