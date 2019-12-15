<?php

namespace App\Providers;

use App;
use App\Models\SettingContact;
use App\Models\SettingDeveloper;
use App\Models\SettingGeneral;
use Cache;
use Illuminate\Support\ServiceProvider;
use Schema;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $seconds = 10;
        if(! Schema::hasTable('setting_generals') || SettingGeneral::first() === null){
            return 'general settings does not exist!';
        }
        $general_settings = Cache::remember('settings.general', $seconds, function () {
            $general_setings_database = SettingGeneral::first();
            if($general_setings_database) {return $general_setings_database->toArray(); }
            return [];
        });
        $contact_settings = Cache::remember('settings.contact', $seconds, function () {
            $contact_setings_database = SettingContact::first();
            if($contact_setings_database) {return $contact_setings_database->toArray(); }
            return [];
        });
        $developer_settings = Cache::remember('settings.developer', $seconds, function () {
            $developer_setings_database = SettingDeveloper::first();
            if($developer_setings_database) {return $developer_setings_database->toArray(); }
            return [];
        });
        config(['setting-general' => $general_settings]);
        config(['setting-contact' => $contact_settings]);
        config(['setting-developer' => $developer_settings]);
        config(['app.name' => config('setting-general.app_title')]);
        config(['app.debug' => config('setting-developer.app_debug')]);
        config(['app.env' => config('setting-developer.app_env')]);
        config(['app.locale' => config('setting-developer.app_language')]);
        App::setLocale(config('setting-developer.app_language'));
        config(['sms.driver' => config('setting-developer.sms_driver')]);
        config(['sms.sender' => config('setting-developer.sms_sender')]);
        config(['sms.api_key' => config('setting-developer.sms_api_key')]);
        config(['mail.username' => config('setting-developer.email_username')]);
        config(['mail.password' => config('setting-developer.email_password')]);
        config(['mail.from.name' => config('setting-general.app_title')]);
        config(['mail.from.address' => config('setting-developer.email_username')]);
        config(['mail.reply_to.name' => config('setting-general.app_title')]);
        config(['mail.reply_to.address' => config('setting-developer.email_username')]);
        // Validator::extend('seo_header', '\App\Rules\SeoHeading@passes');
    }
}
