<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Str;

class DashboardController extends Controller
{
    public function index($shop_subdomain)
    {
        \App::setLocale('fa');
        $shop = Shop::where('url', $shop_subdomain)->first();
        abort_if(! $shop, 404);

        $categories = Category::where('activated', true)
            ->with('products')
            ->orderBy('order', 'asc')
            ->get();

        $meta = [
            'title' => 'Dashboard ' . $shop->title_fa,
            'description' => 'Dashboard ' . $shop->meta_description,
            'keywords' => $shop->keywords,
            'image' => $shop->logo,
            'google_index' => 0,
            'canonical_url' => url()->current(),
        ];

        return view('shop.dashboard', [
            'shop' => $shop,
            'meta' => $meta,
            'categories' => $categories,
            'is_restaurant_close' => 0,
            'under_construction' => 0, 
        ]);
    }

    public function showItem($shop_subdomain, $id)
    {
        $product = Product::where('id', $id)->with('category')->first();

        return json_encode($product);
    }

    public function itemStore($shop_subdomain, Request $request, Product $product)
    {
        $shop = Shop::where('url', $shop_subdomain)->first();
        $last_product = Product::where('category_id', $request->input('folder_id'))
            ->where('shop_id', $shop->id)
            ->orderBy('order', 'desc')
            ->first();
        $product->title = $request->input('name');
        $product->category_id = $request->input('folder_id');
        $product->shop_id = $shop->id;
        if($last_product){
            $product->order = $last_product->order;
        } else {
            $product->order = 1;
        }
        $product->url = Str::slug($product->title);
        $product->save();

        $contents = "$('#" . $request->folder_id . "').children('.items').find('.items_list').append(\"<li class='item _' data-url='" . route('shop.dashboard.showItem', $product->id) . "' data-galleryaddr='" . $product->gallery_address . "' id='item$product->id'><img class='li_item_image hidden' src=''><div class='name'><span class='inner_item_name'>" . $product->title . "</span><span class='count'></span></div><div class='over'></div></li>\");";
        $contents .= "$('.add_item_input').val('');";

        $response  = Response::make($contents, 200);
        $response->header('Content-Type', 'application/javascript');

        return $response;
    }

    public function batchStore($shop_subdomain, Request $request, Category $category)
    {
        $shop = Shop::where('url', $shop_subdomain)->first();
        $last_category = Category::where('shop_id', $shop->id)
            ->orderBy('order', 'desc')
            ->first();
        $category->title = $request->input('name');
        if($last_category){
            $category->order = $last_category->order;
        }
        else{
            $category->order = 1;
        }
        $category->url = Str::slug($category->title);
        $category->save();

        $contents  ="$('.add_card_sw').before(\"<div class='swiper-slide'><ul class='card swiper-no-swiping' id='".$category->id."'><div class='cardheader ui-sortable-handle'><div class='leftsec'><div class='card_name'>".$category->title."</div> <div class='batchicon edit_card' data-id='batch_$category->id'></div> <div class='batchicon card_archive' data-id='$category->id'></div></div><div class='rightsec'><div class='card_icon' data-iconname='default'><img height='100%' width='100%' src='".asset('images/icons/restaurant_pack/default-icon.png')."' /></div><label class='card_select'><input class='select_input' type='checkbox' id='batch_$category->id'></label></div></div><div class='items'><ul class='items_list ui-sortable'></ul><form class='add_item_form' method='post' data-action='".route('shop.dashboard.item.store', ['shop_subdomain' => $shop_subdomain])."' name='addItemForm'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='_method' value='post'><input type='text' class='add_item add_item_input' name='name' placeholder='Add New Item ...' /><input type='hidden' name='folder_id' id='folder_id' value=".$category->id."><input type='submit' value='Add Item' class='add_item_btn'></form></div></ul></div>\");";
        $contents .="$('.add_card_btn').hide();";
        $contents .="$('.add_card_input').val('');";
        $contents .="ItemsdragDrop();enableCreateBatchButton();";

        $response  = Response::make($contents, 200);
        $response->header('Content-Type', 'application/javascript');
        
        return $response;
    }

    public function deleteMainPic($shop_subdomain, Request $request)
    {
        $product = Product::where('id', $request->item_id)->first();
        $product->image = null;
        $product->save();
    }

    public function changeCardSortInBatchPage($shop_subdomain, Request $request)
    {
        for($i = 0; $i< count($request->cards); $i++) {
            Category::where('id', $request->cards[$i])->update(['order' => $request->sorts[$i]]);
        }
    }

    public function test()
    {
        return 1;
    }

    public function updateItem($shop_subdomain, Request $request)
    {
        $product = Product::find($request->id);

        $input = $request->only('name', 'short_description', 'description', 'discount', 'tag', 'main_image', 'type');
        isset($request->price) ? $input['price'] = $request->price : $input['price'] = null;

        // $input['main_image'] = $this->checkMainPicExist($request, $item);
        $product->title = $input['name'];
        $product->price = $input['price'];
        $product->content = $input['short_description'];

        // $product->image = $input['main_image'];
        $product->update();
        // $this->checkEmptyGalleryOrNotToSave($request, $item);
        return 1;
    }

    public function hideItem($shop_subdomain, Request $request)
    {
        $product = Product::find($request->id);
        $product->activated = !$product->activated;
        $product->save();

        return json_encode(!$product->activated);
    }


    public function changeItemSort($shop_subdomain, Request $request)
    {
        $product = Product::find($request->main_item_id);
        $product->update(['category_id' => $request->folder_id]);

        for ($i = 0; $i < count($request->items); $i++) {
            Product::where('category_id', $request->folder_id)
                ->where('id', $request->items[$i])
                ->update(['order' => $request->sorts[$i]]);
        }
    }

    public function changeStatus($shop_subdomain, Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $product->activated = false;
        $product->save();
    }

    public function updateCard($shop_subdomain, Request $request, $id)
    {
        $category = Category::find($id);
        $input = $request->only(['name', 'image']);
        $category->title = $input['name'];
        $category->image = 'http://www.mmenew.ir/cdn/images/icons/restaurant_pack/' . $input['image'];
        $category->update();
    }

    public function changeBatchStatus($shop_subdomain, Request $request)
    {
        $category = Category::find($request->id);
        $category->activated = false;
        $category->save();
    }

    public function menumakerIndex()
    {
        return redirect()->back();
    }

    public function settingsIndex()
    {
        return redirect()->back();
    }

    public function releaseTable()
    {
        return abort(403);
    }

    public function ordersInfo()
    {
        return abort(403);
    }

    public function ordersHistory()
    {
        return abort(403);
    }
}
