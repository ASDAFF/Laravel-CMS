<?php

namespace App\Services;

use App\Models\User;
use Str;
use Tests\TestCase;
use App\Models\Tag;
use App\Models\Category;

class BaseTest extends TestCase
{
    // an aray of models that want to test
    public $model_slugs;

    // single model to test
    public $model_slug;

    public $resource_methods = [
        'print',
        'export',
        'datatable',
        'list.index',
        'list.create',
    ];

    public $front_methods = [
        'index',
        'category.index',
        'tag.index',
    ];

    public function adminTest()
    {
        $this->model_slugs = config('cms.admin_tests');

        foreach($this->model_slugs as $model_slug)
        {
            echo("\nResource Testing ". $model_slug. '...');
            $model_name = Str::studly($model_slug);
            $model_namespace = config('cms.config.models_namespace'). $model_name;
            $model_repository = new $model_namespace();

            $user = User::first();
            $this->actingAs($user);

            // redirect
            $this
                ->get(route('admin.'. $model_slug. '.redirect'))
                ->assertRedirect(route('admin.'. $model_slug. '.list.index'));

            // create fake data for store in database
            $fake_data = factory($model_namespace)->raw();

            // store fake model
            $this
                ->post(route('admin.'. $model_slug. '.list.store', $fake_data))
                ->assertRedirect(route('admin.'. $model_slug. '.list.index'));

            // get fake model that created at this test
            $fake_model = $model_repository->orderBy('id', 'desc')->first();

            // show fake model
            $this
                ->get(route('admin.'. $model_slug. '.list.show', $fake_model))
                ->assertOk();

            // edit fake model
            $this
                ->get(route('admin.'. $model_slug. '.list.edit', $fake_model))
                ->assertOk();

            // update fake model
            $this
                ->put(route('admin.'. $model_slug. '.list.update', $fake_model), $fake_data)
                ->assertRedirect(route('admin.'. $model_slug. '.list.index'));

            // delete fake model
            $this
                ->delete(route('admin.'. $model_slug. '.list.destroy', $fake_model))
                ->assertRedirect(route('admin.'. $model_slug. '.list.index'));

            // restore fake model
            $this
                ->get(route('admin.'. $model_slug. '.list.restore', $fake_model))
                ->assertRedirect(route('admin.'. $model_slug. '.list.index'));

            // force delete fake model
            $fake_model->forceDelete();

            foreach($this->resource_methods as $method)
            {
                $this
                    ->get(route('admin.'. $model_slug. '.'. $method))
                    ->assertOk();
            }
            echo('Done!');
        }
    }

    public function frontTest()
    {
        $this->model_slugs = config('cms.front_tests');

        foreach($this->model_slugs as $model_slug)
        {
            echo "\nFront Testing ". $model_slug. '...';
            $model_name = Str::studly($model_slug);
            $model_namespace = config('cms.config.models_namespace'). $model_name;
            $model_repository = new $model_namespace();

            $user = User::first();
            $this->actingAs($user);

            // get fake model that created at this test
            $fake_model = $model_repository->orderBy('id', 'desc')->first();

            // show fake model
            $this
                ->get(route('front.'. $model_slug. '.show', $fake_model->url))
                ->assertOk();

            // get model category
            $category_model = Category::ofType($model_name)->first();
            // show category of model
            if($category_model){
                $this
                    ->get(route('front.'. $model_slug. '.category.show', $category_model->url))
                    ->assertOk();
                echo "With Category...";
            }

            // get model tag
            $tag_model = Tag::ofType($model_name)->first();
            
            // show tag of model
            if($tag_model){
                $this
                    ->get(route('front.'. $model_slug. '.tag.show', $tag_model->url))
                    ->assertOk();
                echo "With Tag...";
            }

            foreach($this->front_methods as $method)
            {
                $this
                    ->get(route('front.'. $model_slug. '.'. $method))
                    ->assertOk();
            }
            echo('Done!');
        }
    }
}
