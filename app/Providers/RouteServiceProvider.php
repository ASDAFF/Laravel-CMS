<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $domain = config('app.url');
        $this->mapAdminRoutes($domain);
        $this->mapShopRoutes($domain);
        $this->mapApiRoutes();
        $this->mapAuthRoutes();
        $this->mapFrontRoutes($domain);
    }

    protected function mapAdminRoutes($domain)
    {
        Route::middleware(['web', 'throttle:25,0.1', 'auth'])
            ->domain('www.admin.' . $domain)
            ->as('admin.')
            ->namespace($this->namespace . '\Admin')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapShopRoutes($domain)
    {
        Route::middleware(['web', 'throttle:35,0.1'])
            ->domain('www.{shop_subdomain}.' . $domain)
            ->as('shop.')
            ->namespace($this->namespace . '\Shop')
            ->group(base_path('routes/shop.php'));
    }

    protected function mapFrontRoutes($domain)
    {
        Route::middleware(['web'])
            ->domain('www.' . $domain)
            ->as('front.')
            ->namespace($this->namespace . '\Front')
            ->group(base_path('routes/front.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->as('api.')
            ->middleware(['api', 'throttle:15,0.3'])
            ->namespace($this->namespace . '\Api')
            ->group(base_path('routes/api.php'));
    }

    protected function mapAuthRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/auth.php'));
    }
}
