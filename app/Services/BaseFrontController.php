<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Maatwebsite\Excel\Facades\Excel;
use Route;
use View;
use Spatie\Activitylog\Models\Activity;

class BaseFrontController extends Controller
{
    // public $model = 'Blog';
    public $model;

    // public $model_sm = 'blog';
    public $model_sm;

    // public $model_trans = 'Blog';
    public $model_trans;

    // App\Models\Blog
    public $model_class;

    // App\Models\Blog
    public $model_columns;

    public $repository;

    public $request;

    public $meta;

    public function __construct(Request $request)
    {
        $this->model_trans = __(strtolower($this->model));
        $this->model_class = 'App\\Models\\' . $this->model;
        $this->model_sm = lcfirst($this->model);
        $this->repository = new $this->model_class();
        $this->request = $request;
        $this->model_columns = $this->repository->getColumns();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->meta = [
            'title' => config('setting-general.default_meta_title') . ' | ' . 'Blogs',
            'description' => config('setting-general.default_meta_description'),
            'keywords' => '',
            'image' => config('setting-general.default_meta_image'),
            'google_index' => config('setting-general.google_index'),
            'canonical_url' => url()->current(),
        ];            

        $list = $this->repository->active()->language()
            ->orderBy('updated_at', 'desc')
            ->paginate(config('setting-general.pagination_number'));

        return view('front.list.index', ['meta' => $this->meta, 'list' => $list]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $model = $this->repository->where('url', $url)->first();
        $data = $model;

        foreach($this->model_columns as $column){
            if($column['form_type'] === 'file' && $column['file_manager'] === false){
                $data[$column['name']] = $data->files_src($column['name']);
            }
        }

        if(env('APP_ENV') !== 'testing'){
            activity($this->model)->performedOn($model)->causedBy(Auth::user())
                ->log($this->model . ' View');
        }

        return view('front.list.show', ['data' => $data, 'meta' => $this->meta]);
    }

    public function getCategories () 
    {
        $this->meta = [
            'title' => config('setting-general.default_meta_title') . ' | ' . __('blog categories'),
            'description' => __('blog categories description'),
            'keywords' => '',
            'image' => config('setting-general.default_meta_image'),
            'google_index' => config('setting-general.google_index'),
            'canonical_url' => url()->current(),
        ];

        // $list = Category::ofType('blog')->active()->language()
        $list = Category::active()->language()
            ->orderBy('updated_at', 'desc')
            ->paginate(config('setting-general.pagination_number'));

        return view('front.list.index', ['meta' => $this->meta, 'list' => $list]);
    }
}
