<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class BlogForm extends Form
{
    public function buildForm()
    {
        dd(1);
    	$id = $this->model ? $this->model->id : 0;
        $this
            ->add('url', 'text-m', [
            	'rules' => 'required|max:80|regex:/^[a-z0-9-_]+$/|unique:blogs,url,' . $id,
            	'help_block' => [
			        'text' => 'Url should be unique, contain lowercase characters and numbers and -',
			    ],
            ])
            ->add('title', 'text-m', [
                'rules' => 'required|max:60|min:10|unique:blogs,title,' . $id,
                'help_block' => [
			        'text' => 'Title should be unique, minimum 10 and maximum 60 characters.',
			    ],
            ])
            ->add('short_content', 'textarea', [
                'rules' => 'nullable|max:191',
                'help_block' => [
			        'text' => 'Short content will show in lists instead of content.',
			    ],
                'attr' => ['rows' => '2'],
            ])
            ->add('content', 'ckeditor', [
                'rules' => 'required|seo_header',
            ])
            ->add('tags', 'entity', [
                'class' => 'Conner\Tagging\Model\Tag',
                'property' => 'name',
                'property_key' => 'id',
                'attr' => ['multiple' => 'true', 'class' => 'form-control m-bootstrap-select m-bootstrap-select--pill m-bootstrap-select--air m_selectpicker', 'data-live-search' => 'true'],
            ])
            // ->add('category', 'entity', [
            //     'class' => 'App\Models\Category',
            //     'property' => 'name',
            //     'property_key' => 'id',
            //     'attr' => ['class' => 'form-control m-bootstrap-select m-bootstrap-select--pill m-bootstrap-select--air m_selectpicker', 'data-live-search' => 'true'],
            // ])
            // ->add('related_blogs', 'entity', [
            //     'class' => 'App\Models\Blog',
            //     'property' => 'title',
            //     'property_key' => 'id',
            //     'attr' => ['multiple' => 'true', 'class' => 'form-control m-bootstrap-select m-bootstrap-select--pill m-bootstrap-select--air m_selectpicker', 'data-live-search' => 'true'],
            // ])
            ->add('meta_description', 'text-m', [
                'rules' => 'required|max:191|min:70',
                'help_block' => [
			        'text' => 'Meta description should have minimum 70 and maximum 191 characters.',
			    ],
            ])
            ->add('keywords', 'text-m', [
                'rules' => 'nullable|max:191',
                'attr' => ['placeholder' => 'Its not important for google anymore'],
            ])
            ->add('meta_image', 'text-m', [
                'rules' => 'nullable|max:191|url',
                'attr' => ['placeholder' => 'Meta image shows when this page is shared in social networks.'],
            ])
            ->add('published', 'switch-m', [
            ])
            ->add('google_index', 'checkbox-m', [
                'help_block' => [
                    'text' => 'Google will index this page.',
                ],
            ])
            ->add('canonical_url', 'text-m', [
                'rules' => 'nullable|max:191|url',
                'help_block' => [
			        'text' => 'Canonical url just used for seo redirect duplicate contents.',
			    ],
                'attr' => ['placeholder' => 'Leave it empty if you dont need any google redirection.'],
            ])
            ->add('submit', 'submit');
    }
}
