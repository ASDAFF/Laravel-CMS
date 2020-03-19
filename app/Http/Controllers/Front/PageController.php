<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex($page_url = null, Request $request)
    {
        $page = Page::where('url', $page_url)->active()->first();
        abort_if(! $page, 404);
        if(config('app.name') === 'map'){
            return view('front.test.map.offline-city');
        }

        return view('front.page', ['page' => $page]);
    }

    public function postSubmitForm($form_id, Request $request, \App\Models\Answer $answer)
    {
        $form_model = Form::find($form_id);
        $form = \FormBuilder::create(\App\Forms\CustomeForm::class, ['form_model' => $form_model]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $main_data = $data;
        $files = [];
        foreach($main_data as $key => $item){
            if(is_object($item)){
                $files[$key] = $item;
                unset($data[$key]);
            }
        }
        $answer->activated = 1;
        $answer->user_id = \Auth::id();
        $answer->form_id = $form_model->id;
        $answer->answers = serialize($data);
        $answer->save();

        // upload files
        foreach($files as $column => $file) {
            $file_service = new \App\Services\FileService();
            $file_service->save($file, $answer, $column);
        }

        $request->session()->flash('alert-success', 'Congratulation, Your answer saved successfully!');

        return redirect()->back();
    }
}
