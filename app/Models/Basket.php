<?php

namespace App\Models;

use App\Services\BaseModel;

class Basket extends BaseModel
{
    public $columns = [
        ['name' => 'activated'],
        [
            'name' => 'user_id',
            'relation' => 'users',
        ],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }

    public static function getTotalPriceByRestaurantId($restaurantId)
    {
        // $restaurantId
        return 12;
    }
}
