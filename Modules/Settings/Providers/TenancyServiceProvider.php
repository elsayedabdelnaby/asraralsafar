<?php

declare(strict_types=1);

namespace Modules\Settings\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TenancyServiceProvider extends ServiceProvider
{
    // By default, no namespace is used to support the callable array syntax.
    public static string $controllerNamespace = 'Modules\Settings\Http\Controllers';

    /**
     * @return void
     */
    public function boot()
    {
        $this->mapRoutes();
    }

    protected function mapRoutes()
    {
        if (file_exists(module_path('Settings', '/Routes/tenant.php'))) {
            Route::namespace(static::$controllerNamespace)
                ->group(module_path('Settings', '/Routes/tenant.php'));
        }
    }
}
