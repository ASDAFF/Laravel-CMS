<?php

namespace App\Models;

use Actuallymab\LaravelComment\CanComment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use CanComment;
    use HasApiTokens;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    public $columns = [
        [
            'name' => 'first_name',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'max:100',
            'help' => '',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'last_name',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'max:100',
            'help' => '',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'email',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'required|unique:users,email,',
            'help' => '',
            'form_type' => 'email',
            'table' => true,
        ],
        [
            'name' => 'phone',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable|min:5|max:16',
            'help' => 'Mobile Number',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'telephone',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable|min:5|max:16',
            'help' => 'Home Number',
            'form_type' => '',
            'table' => false,
        ],
        [
            'name' => 'national_code',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable|numeric|digits_between:10,10',
            'help' => 'National Code',
            'form_type' => '',
            'table' => false,
        ],
        [
            'name' => 'gender',
            'type' => 'boolean',
            'database' => 'default',
            'rule' => 'boolean',
            'help' => '',
            'form_type' => 'switch-bootstrap-m',
            'table' => false,
        ],
        [
            'name' => 'birth_date',
            'type' => 'date',
            'database' => 'nullable',
            'rule' => 'nullable|date',
            'help' => '',
            'form_type' => 'date',
            'table' => false,
        ],
        [
            'name' => 'salary',
            'type' => 'integer',
            'database' => 'nullable',
            'rule' => 'nullable|integer',
            'help' => '',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'url',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable|max:80|regex:/^[a-z0-9-]+$/',
            'help' => 'Url should be unique, contain lowercase characters and numbers and -',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'website',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable|url|max:190',
            'help' => '',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'bio',
            'type' => 'text',
            'database' => 'nullable',
            'rule' => 'nullable',
            'help' => '',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'image',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable|max:191',
            'help' => '',
            'form_type' => 'image',
            'table' => false,
        ],
        [
            'name' => 'activation_code',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable',
            'help' => '',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'email_verified_at',
            'type' => 'timestamp',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'phone_verified_at',
            'type' => 'timestamp',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'national_card_verified_at',
            'type' => 'timestamp',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'bank_card_verified_at',
            'type' => 'timestamp',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => 'none',
            'table' => false,
        ],
        [
            'name' => 'certificate_card_verified_at',
            'type' => 'timestamp',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => 'none',
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
            'name' => 'status',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => 'nullable',
            'help' => '',
            'form_type' => 'none', //enum
            'form_enum_class' => 'UserStatus',
            'table' => false,
        ],
        [
            'name' => 'password',
            'type' => 'string',
            'database' => '',
            'rule' => 'nullable|confirmed|min:3|max:100',
            'help' => 'If you let this field be empty in update password will not change.',
            'form_type' => 'password',
            'table' => false,
        ],
        [
            'name' => 'password_confirmation',
            'type' => 'string',
            'database' => 'none',
            'rule' => 'nullable',
            'help' => 'Password should match confirm password.',
            'form_type' => '',
            'table' => false,
        ],
    ];

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function addresses()
    {
        return $this->hasMany('App\Models\Address', 'user_id', 'id');
    }

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function canCommentWithoutApprove(): bool
    {
        return false;
        return $this->activated;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getImageAttribute($image)
    {
        if(isset($image)) {
            return $image;
        }

        return config('setting-general.default_user_image');
    }

    public function getAssetImageAttribute()
    {
        return asset($this->image);
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function getNationalCardImagesAttribute()
    {
        return $this->images->where('title', 'national_card');
    }

    public function getBankCardImagesAttribute()
    {
        return $this->images->where('title', 'bank_card');
    }

    public function getCertificateCardImagesAttribute()
    {
        return $this->images->where('title', 'certificate_card');
    }

    public function getAdminUser()
    {
        return User::where('id', 1)->first();
    }
}
