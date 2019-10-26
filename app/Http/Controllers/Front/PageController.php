<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Page;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex($page_url = '/')
    {
        if(config('app.name') === 'map'){
            return view('front.test.map.offline-city');
        }

        $page = Page::where('url', $page_url)->active()->first();
        abort_if(! $page, 404);

        if(config('app.name') === 'map'){
            return view('front.test.map.offline-city');
            // $ip = $_SERVER['REMOTE_ADDR'];
            // try{
            //     if($ip === '127.0.0.1'){
            //         return view('front.test.map.offline-city');
            //     }else{
            //         $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
            //         if($details->country === 'IR'){
                        
            //         }
            //     }
            // }
            // catch(Exception $e){}
        }

        $meta = [
            'title' => config('0-general.default_meta_title') . ' | ' . $page->title,
            'description' => $page->meta_description ?: config('0-general.default_meta_description'),
            'keywords' => $page->keywords,
            'image' => $page->image ? asset($page->image) : asset(config('0-general.default_meta_image')),
            'google_index' => config('0-general.google_index') ?: $page->google_index,
            'canonical_url' => $page->canonical_url ?: url()->current(),
        ];

        $blocks = Block::getPageBlocks($page->id);

        return view('front.page', ['blocks' => $blocks, 'page' => $page, 'meta' => $meta]);
    }

    public function postSubscribe(Request $request)
    {
        $date = Carbon::now()->format('Y/d/m');
        $time = Carbon::now()->format('H:i');
        $email = $request->input('email');

        if(! User::where('email', $email)->first()){
            User::create([
                'first_name' => $date,
                'last_name' => $time,
                'email' => $email,
                'status' => 2,
                'password' => 'farid123SS!@#%#@$FDSAddd' . rand(200, 1000),
            ]);
        }

        $request->session()->flash('alert-success', 'Congratulation, you will go solar soon!');

        return redirect()->route('front.page.index', '/');
    }
}
