<?php

namespace App\Providers;

use App\Policies\ActivityPolicy;
use App\Policies\AddressPolicy;
use App\Policies\AnswerPolicy;
use App\Policies\BlockPolicy;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use App\Policies\CountingPolicy;
use App\Policies\FactorPolicy;
use App\Policies\FeaturePolicy;
use App\Policies\FeedbackPolicy;
use App\Policies\FieldPolicy;
use App\Policies\FormPolicy;
use App\Policies\ImagePolicy;
use App\Policies\MenuPolicy;
use App\Policies\ModulePolicy;
use App\Policies\NotificationPolicy;
use App\Policies\PagePolicy;
use App\Policies\PartnerPolicy;
use App\Policies\PricingPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ServicePolicy;
use App\Policies\SettingContactPolicy;
use App\Policies\SettingDeveloperPolicy;
use App\Policies\SettingGeneralPolicy;
use App\Policies\ShopPolicy;
use App\Policies\SliderPolicy;
use App\Policies\TagendPolicy;
use App\Policies\TagPolicy;
use App\Policies\TeamPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\Address' => AddressPolicy::class,
        'App\Models\Activity' => ActivityPolicy::class,
        'App\Models\Answer' => AnswerPolicy::class,
        'App\Models\Block' => BlockPolicy::class,
        'App\Models\Blog' => BlogPolicy::class,
        'App\Models\Counting' => CountingPolicy::class,
        'App\Models\Category' => CategoryPolicy::class,
        'App\Models\Comment' => CommentPolicy::class,
        'App\Models\Factor' => FactorPolicy::class,
        'App\Models\Feature' => FeaturePolicy::class,
        'App\Models\Feedback' => FeedbackPolicy::class,
        'App\Models\Field' => FieldPolicy::class,
        'App\Models\Form' => FormPolicy::class,
        'App\Models\Image' => ImagePolicy::class,
        'App\Models\Notification' => NotificationPolicy::class,
        'App\Models\Menu' => MenuPolicy::class,
        'App\Models\Module' => ModulePolicy::class,
        'App\Models\Partner' => PartnerPolicy::class,
        'App\Models\Page' => PagePolicy::class,
        'App\Models\Permission' => UserPolicy::class,
        'App\Models\Pricing' => PricingPolicy::class,
        'App\Models\Product' => ProductPolicy::class,
        'App\Models\Role' => UserPolicy::class,
        'App\Models\Service' => ServicePolicy::class,
        'App\Models\SettingGeneral' => SettingGeneralPolicy::class,
        'App\Models\SettingContact' => SettingContactPolicy::class,
        'App\Models\SettingDeveloper' => SettingDeveloperPolicy::class,
        'App\Models\Shop' => ShopPolicy::class,
        'App\Models\Slider' => SliderPolicy::class,
        'App\Models\Tag' => TagPolicy::class,
        'App\Models\Tagend' => TagendPolicy::class,
        'App\Models\Team' => TeamPolicy::class,
        'App\Models\User' => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });

        Passport::routes();
    }
}
