<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Base\BaseAdminController;
use Auth;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Spatie\Activitylog\Models\Activity;

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
        $this->meta['title'] = __('Profile');
    }

    public function index()
    {
        $this->meta['title'] = __('Dashboard');
        $this->meta['alert'] = 'Admin Panel Dashboard For Best Cms In The World With LARAVEL!';

        return view('admin.report', ['meta' => $this->meta]);
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
        $main_data = $data;

        foreach(collect($this->model_columns)->where('type', 'boolean')->pluck('name') as $boolean_column)
        {
            if(! isset($data[$boolean_column]))
            {
                $data[$boolean_column] = 0;
            }
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
    	$activities = Activity::where('causer_id', Auth::id())->get();

    	return view('admin.activity', ['activities' => $activities, 'meta' => $this->meta]);
    }
}
