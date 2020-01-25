<?php

namespace App\Models;

use App\Services\BaseModel;
use App\Services\FactorService;

class Factor extends BaseModel
{
    public $columns = [
    	[
            'name' => 'total_price',
            'type' => 'unsignedBigInteger',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'shipping',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => '',
            'table' => false,
        ],
        [
            'name' => 'payment',
            'type' => 'string',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => '',
            'table' => false,
        ],
        [
            'name' => 'user_description',
            'type' => 'text',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => 'textarea',
            'table' => false,
        ],
        [
            'name' => 'admin_description',
            'type' => 'text',
            'database' => 'nullable',
            'rule' => '',
            'help' => '',
            'form_type' => 'textarea',
            'table' => false,
        ],
        [
            'name' => 'admin_seen',
            'type' => 'boolean',
            'database' => 'default',
            'rule' => '',
            'help' => '',
            'form_type' => 'checkbox',
            'table' => true,
        ],
        [
            'name' => 'status',
            'type' => 'unsignedTinyInteger',
            'database' => 'default',
            'rule' => '',
            'help' => '',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'address_id',
            'type' => 'bigInteger',
            'database' => 'unsigned',
            'relation' => 'addresses',
            'rule' => 'nullable|exists:addresses,id',
            'help' => '',
            'form_type' => 'entity',
            'class' => 'App\Models\Address',
            'property' => 'address',
            'property_key' => 'id',
            'multiple' => false,
            'table' => false,
        ],
        ['name' => 'user_id'],
        ['name' => 'activated'],
    ];

    const STATUS_INITIAL = 1;
    const STATUS_PAYMENT = 2;
    const STATUS_PROCCESSING = 3;
    const STATUS_PREPARING = 4;
    const STATUS_DELIVERING = 5;
    const STATUS_CANCELED = 6;
    const STATUS_SUCCEED = 7;

    public function scopeCurrentFactor($query)
    {
        return $query->where('user_id', \Auth::id())
            ->where('status', '<', 3)
            // ->where('admin_seen', 0)
            // ->where('created_at', '>', carbon::now()->subHour() )
            ->orderBy('id', 'desc');            
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('count')->withPivot('price')->withPivot('discount_price');
    }

    public function fillFactorProducts()
    {
        $this->products()->sync([]);
        $basket = FactorService::_getUserBasket();

        foreach($basket->products as $product) 
        {
            if($product->activated !== 1){
                continue;
            }
            $count = $product->pivot->count;
            $this->products()->syncWithoutDetaching([
                $product->id => [
                    'count' => $count,
                    'price' =>  $product->price,
                    'discount_price' =>  $product->discount_price,
                ]
            ]);
        }

        return $this;
    }

    public function fillFactorTagends()
    {
        $tagends = Tagend::forced()
            ->get();

        foreach ($tagends as $tagend) 
        {
            $this->addTagendToFactor($tagend);
        }

        return $this;
    }

	public function calculateTotalPriceWithTagends()
    {
        $total_price = $this->total_price_products();

        foreach($this->tagends as $tagend)
        {
            $total_price = $total_price + $tagend->pivot->value; 
        }
        if($total_price < 0){
            $total_price = 0;
        }
        return $total_price;
    }

    public function total_price_products()
    {
        $factor_product = $this->products()->get();
        $total_price = 0;
        foreach($factor_product as $item)
        {
            if($item->pivot->discount_price){
                $total_price = $total_price + ( $item->pivot->count * $item->pivot->discount_price );
            }else{
                $total_price = $total_price + ( $item->pivot->count * $item->pivot->price );
            }
        }
        return $total_price;
    }
}
