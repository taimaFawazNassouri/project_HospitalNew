<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard/user';
    public const ADMIN = '/dashboard/admin';
    public const DOCTOR = '/dashboard/doctor';
    public const RAYEMPLOYEE = '/dashboard/ray_employee';
    public const LABORATORIEEMPLOYEE = '/dashboard/laboratorie_employee';
    public const PATIENT = '/dashboard/patient';





    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        Livewire::addPersistentMiddleware([ 
            App\Http\Middleware\RedirectIfAuthenticated::class,
        ]);
      
      
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            Route::middleware('web')
                ->group(base_path('routes/Backend.php'));
            Route::middleware('web')
                ->group(base_path('routes/doctor.php'));
            Route::middleware('web')
                ->group(base_path('routes/RayEmployee.php'));
            Route::middleware('web')
                ->group(base_path('routes/LaboratorieEmployee.php'));
            Route::middleware('web')
                ->group(base_path('routes/Patient.php'));
        });
    }
}
