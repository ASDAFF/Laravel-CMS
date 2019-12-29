<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Base\BaseAdminController;
use Auth;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Route;
use Spatie\Activitylog\Models\Activity;
use App\Notifications\EmailVerified;
use App\Notifications\PhoneVerified;
use Carbon\Carbon;

class DashboardController extends BaseAdminController
{
	public function __construct(Request $request, FormBuilder $form_builder)
    {
        $this->model_class = 'App\\Models\\User';
        $this->model_form = 'App\\Forms\\UserForm';
        $this->repository = new $this->model_class();
        $this->request = $request;
        $this->form_builder = $form_builder;
        $this->model_columns = $this->repository->getColumns();
        $this->meta['title'] = __('profile');
        $this->meta['link_name'] = __('dashboard');
    }

    public function index()
    {
        $this->meta['title'] = __('dashboard');
        return view('admin.dashboard.index', ['meta' => $this->meta]);
    }

    public function redirect()
    {
        return redirect()->route('admin.dashboard.list.index');
    }

    public function getProfile()
    {
    	$form = $this->form_builder->create($this->model_form, [
            'method' => 'PUT',
            'url' => route('admin.dashboard.update-profile'),
            'class' => 'm-form m-form--state',
            'id' =>  'admin_form',
            'model' => Auth::user(),
        ]);

    	return view('admin.list.form', ['form' => $form, 'meta' => $this->meta]);
    }

    public function updateProfile()
    {
        $model = Auth::user();

        $form = $this->form_builder->create($this->model_form, [
            'model' => $model,
        ]);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();

        foreach(collect($this->model_columns)->where('type', 'boolean')->pluck('name') as $boolean_column)
        {
            if(! isset($data[$boolean_column]))
            {
                $data[$boolean_column] = 0;
            }
        }

        if($model->email !== $data['email']){
            $model->activation_code = null;
            $model->email_verified_at = null;
        }

        if($model->phone !== $data['phone']){
            $model->activation_code = null;
            $model->phone_verified_at = null;
        }

        if(isset($data['password'])) {
            $data['password'] = \Hash::make($data['password']);
        }
        else{
            $data['password'] = $model->password;
        }

        unset($data['password_confirmation']);
        $model->update($data);

        activity('User')
            ->performedOn($model)
            ->causedBy(Auth::user())
            ->log('User Profile Updated');
        $this->request->session()->flash('alert-success', $this->model . ' Updated Successfully!');

        return redirect()->route('admin.dashboard.profile');
    }

    public function getActivity()
    {
        $this->meta['title'] = __('activity');
        $this->meta['alert'] = '';
    	$activities = Activity::where('causer_id', Auth::id())
    	    ->orderBy('id', 'desc')
    	    ->get();

    	return view('admin.dashboard.activity', ['activities' => $activities, 'meta' => $this->meta]);
    }

    public function getIdentify()
    {
        $this->meta['title'] = __('identify');

        return view('admin.dashboard.identify', ['meta' => $this->meta]);
    }

    public function getIdentifyEmail()
    {
        $auth_user = Auth::user();
        if($auth_user->email_verified_at){
            return redirect()->back();
        }
        if(!$auth_user->activation_code){
            $code = rand(1000,9999);
            $code = 1111;
            $auth_user->activation_code = $code;
            // send code with email
            $email_verified =  new EmailVerified();
            $email_verified->setCode($code);
            $auth_user->notify($email_verified);
            $auth_user->update();
        }
        $this->meta['title'] = __('identify email');

        return view('admin.dashboard.identify-email', ['meta' => $this->meta]);
    }

    public function postIdentifyEmail()
    {
        $auth_user = Auth::user();
        if($auth_user->email_verified_at){
            return redirect()->back();
        }
        $activation_code = $this->request->input('activation_code');
        if($auth_user->activation_code === $activation_code)
        {
            $auth_user->email_verified_at = Carbon::now();
            $auth_user->activation_code = null;
            $auth_user->update();

            $this->request->session()->flash('alert-success', __('email_verified'));
            return redirect()->route('admin.dashboard.identify');
        }
        else
        {
            $this->request->session()->flash('alert-danger', __('wrong_activation_code'));
            return redirect()->back();
        }
    }

    public function getIdentifyPhone()
    {
        $auth_user = Auth::user();
        if($auth_user->phone_verified_at){
            return redirect()->back();
        }
        if(!$auth_user->activation_code){
            $code = rand(1000,9999);
            $code = 1111;
            $auth_user->activation_code = $code;
            $phone_verified =  new PhoneVerified();
            $phone_verified->setCode($code);
            $auth_user->notify($phone_verified);
            $auth_user->update();
        }
        $this->meta['title'] = __('identify phone');

        return view('admin.dashboard.identify-phone', ['meta' => $this->meta]);
    }

    public function postIdentifyPhone()
    {
        $auth_user = Auth::user();
        if($auth_user->phone_verified_at){
            return redirect()->back();
        }
        $activation_code = $this->request->input('activation_code');
        if($auth_user->activation_code === $activation_code)
        {
            $auth_user->phone_verified_at = Carbon::now();
            $auth_user->activation_code = null;
            $auth_user->update();

            $this->request->session()->flash('alert-success', __('phone_verified'));
            return redirect()->route('admin.dashboard.identify');
        }
        else
        {
            $this->request->session()->flash('alert-danger', __('wrong_activation_code'));
            return redirect()->back();
        }
    }
}
