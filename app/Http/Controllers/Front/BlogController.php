<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public $blog_page;

    public $meta;

    public function __construct()
    {
        $this->blog_page = Page::where('url', 'blog')->active()->first();
        abort_if(! $this->blog_page, 404);

        // $meta = [
        //     'title' => config('setting-general.default_meta_title') . ' | ' . $page->title,
        //     'description' => $page->meta_description ?: config('setting-general.default_meta_description'),
        //     'keywords' => $page->keywords,
        //     'image' => $page->asset_image ?: asset(config('setting-general.default_meta_image')),
        //     'google_index' => config('setting-general.google_index') ?: $page->google_index,
        //     'canonical_url' => $page->canonical_url ?: url()->current(),
        // ];
        
        // $this->meta = [
        //     'title' => config('setting-general.app_name') . ' | Blogs',
        //     'description' => config('setting-general.default_meta_description'),
        //     'keywords' => '',
        //     'image' => config('setting-general.default_meta_image'),
        //     'google_index' => $page->google_index,
        //     'canonical_url' => $page->canonical_url ?: url()->current(),
        // ];
    }

    public function postComment(Request $request, $blog_id)
    {
        $blog = Blog::where('id', $blog_id)->active()->first();
        abort_if(! $blog, 404);

        $user = Auth::User();
        $user->comment($blog, $request->input('comment'), $request->input('rate'));

        $request->session()->flash('alert-success', __('comment_created'));

        return redirect()->back();
    }

    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->active()->paginate(config('setting-general.pagination_number'));

        return view('front.page', ['page' => $page, 'blogs' => $blogs]);
    }

    public function show($blog_id)
    {
        $blog = Blog::where('id', $blog_id)->active()->first();
        abort_if(! $blog, 404);

        $page = Page::where('url', 'blog')->active()->first();
        abort_if(! $page, 404);

        // $meta = [
        //     'title' => $blog->title,
        //     'description' => $blog->meta_description,
        //     'keywords' => $blog->keywords,
        //     'image' => $blog->meta_image,
        //     'google_index' => $blog->google_index,
        //     'canonical_url' => $blog->canonical_url ?: url()->current(),
        // ];

        return view('front.page', ['page' => $page, 'blog' => $blog]);
    }

    public function getCategories()
    {
        $page = Page::where('url', 'blog')->active()->first();
        abort_if(! $page, 404);
        $categories = Category::active()->get();

        // $meta = [
        //     'title' => config('setting-general.app_name') . ' | Category Of Blogs',
        //     'description' => config('setting-general.default_meta_description'),
        //     'keywords' => '',
        //     'image' => config('setting-general.default_meta_image'),
        //     'google_index' => $page->google_index,
        //     'canonical_url' => $page->canonical_url ?: url()->current(),
        // ];

        return view('front.page', ['page' => $page, 'categories' => $categories]);
    }

    public function getCategory($category_url)
    {
        $category = Category::where('url', $category_url)->first();
        abort_if(! $category, 404);

        $categories = Category::get();
        $blogs = Blog::where('category_id', $category->id)->orderBy('id', 'desc')->paginate(config('setting-general.pagination_number'));

        $page = Page::where('url', 'blog')->first();
        abort_if(! $page, 404);

        // $meta = [
        //     'title' => config('setting-general.app_name') . ' | ' . $category->title,
        //     'description' => $category->meta_description,
        //     'keywords' => '',
        //     'image' => $category->meta_image,
        //     'google_index' => $category->google_index,
        //     'canonical_url' => $category->canonical_url ?: url()->current(),
        // ];

        return view('front.page', ['page' => $page, 'meta' => $meta, 'blogs' => $blogs, 'category' => $category, 'categories' => $categories]);
    }

    public function getTags()
    {
        $categories = Tag::get();
        $blogs = Blog::orderBy('id', 'desc')->paginate(config('setting-general.pagination_number'));

        $page = Page::where('url', 'blog')->active()->first();
        abort_if(! $page, 404);

        // $meta = [
        //     'title' => config('setting-general.app_name') . ' | Tag Of Blogs',
        //     'description' => config('setting-general.default_meta_description'),
        //     'keywords' => '',
        //     'image' => config('setting-general.default_meta_image'),
        //     'google_index' => $page->google_index,
        //     'canonical_url' => $page->canonical_url ?: url()->current(),
        // ];

        return view('front.page', ['page' => $page, 'meta' => $meta, 'blogs' => $blogs, 'categories' => $categories]);
    }

    public function getTag($tag_url)
    {
        $category = Tag::where('slug', $tag_url)->first();
        abort_if(! $category, 404);

        $blogs = Blog::withAnyTag([$category->name])->orderBy('id', 'desc')->paginate(config('setting-general.pagination_number'));

        $page = Page::where('url', 'blog')->first();
        abort_if(! $page, 404);

        // $meta = [
        //     'title' => config('setting-general.app_name') . ' | ' . $category->title,
        //     'description' => config('setting-general.default_meta_description'),
        //     'keywords' => '',
        //     'image' => config('setting-general.default_meta_image'),
        //     'google_index' => $page->google_index,
        //     'canonical_url' => $page->canonical_url ?: url()->current(),
        // ];

        return view('front.page', ['page' => $page, 'meta' => $meta, 'blogs' => $blogs, 'category' => $category]);
    }
}
