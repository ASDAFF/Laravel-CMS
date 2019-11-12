<?php

namespace App\Http\Controllers\Admin\Block;

use App\Base\BaseListController;
use App\Models\Block;

class ResourceController extends BaseListController
{
    public $model = 'Block';

    public function index()
    {
        $this->authorize('index', $this->model_class);
        $this->meta['title'] = __($this->model . ' Manager');
        $this->meta['alert'] = 'This CMS is Block Base, It means every part of website can change so easily and can be sort';
        $this->meta['link_name'] = __('Create New ' . $this->model);
        $this->meta['link_route'] = route('admin.' . $this->model_sm . '.list.create');
        $this->meta['search'] = 1;
        $columns = [];
        foreach(collect($this->model_columns)->where('table', true) as $column)
        {
            $columns[] = [
                'field' => $column['name'],
                'title' => preg_replace('/([a-z])([A-Z])/s', '$1 $2', \Str::studly($column['name'])),
            ];
        }
        $blocks = Block::orderBy('order', 'asc')
            ->where('type', '!=', 'loading')
            ->get();

        return view('admin.list.sortable-table', ['meta' => $this->meta, 'columns' => $columns, 'blocks' => $blocks]);
    }

    public function postSort()
    {
    	$block_sort_json = $this->request->blockSort;
    	$block_sort = json_decode($block_sort_json);
    	$this->saveSort($block_sort);
    	$this->request->session()->flash('alert-success', $this->model . ' Order Updated Successfully!');

        return redirect()->route('admin.' . $this->model_sm . '.list.index');
    }

    public function saveSort($block_ids)
    {
    	foreach($block_ids as $block_order => $block_id)
    	{
    		$block = Block::find($block_id);
    		$block->order = (3 * $block_order) + 1;
    		$block->save();
    	}
    }
}
