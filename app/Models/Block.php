<?php

namespace App\Models;

use App\Base\BaseModel;

class Block extends BaseModel
{
    // widget_type, title, show_all_pages, pages_list, order, activated
    public $columns = [
        [
            'name' => 'widget_type',
            'type' => 'string',
            'database' => '',
            'rule' => 'required',
            'help' => '',
            'form_type' => 'enum',
            'form_enum_class' => 'BlockType',
            'table' => true,
        ],
        [
            'name' => 'title',
            'type' => 'string',
            'database' => '',
            'rule' => 'required',
            'help' => 'title will used in folder name of widget.',
            'form_type' => '',
            'table' => true,
        ],
        [
            'name' => 'show_all_pages',
            'type' => 'boolean',
            'database' => 'default',
            'rule' => 'boolean',
            'help' => 'If this ckecked this block will show in all pages except below pages list',
            'form_type' => 'checkbox', // switch-m
            'table' => false,
        ],
        [
            'name' => 'pages',
            'type' => 'array',
            'database' => 'none',
            'rule' => 'nullable',
            'help' => '',
            'form_type' => 'entity',
            'class' => 'App\Models\Page',
            'property' => 'title',
            'property_key' => 'id',
            'multiple' => true,
            'table' => false,
        ],
        [
            'name' => 'order',
            'type' => 'integer',
            'database' => 'nullable',
            'rule' => 'nullable|numeric',
            'help' => 'Order of block, lower is on top',
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

    public function pages()
    {
        return $this->belongsToMany('App\Models\Page', 'block_page', 'block_id', 'page_id');
    }

    public static function getPageBlocks($page_id)
    {
        $blocks = \App\Models\Block::active()
            ->orderBy('order', 'asc')
            ->get();

        $output_blocks = [];
        foreach($blocks as $block)
        {
            if($block->show_all_pages && array_search($page_id, $block->pages->pluck('id')->toArray()) === false){
                $output_blocks[] = $block;
            }

            if(!$block->show_all_pages && array_search($page_id, $block->pages->pluck('id')->toArray()) !== false){
                $output_blocks[] = $block;
            }
        }
        return $output_blocks;
    }
}
