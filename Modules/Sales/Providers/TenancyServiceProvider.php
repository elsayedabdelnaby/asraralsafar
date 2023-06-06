<?php

declare(strict_types=1);

namespace Modules\Sales\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TenancyServiceProvider extends ServiceProvider
{
    // By default, no namespace is used to support the callable array syntax.
    public static string $controllerNamespace = 'Modules\Sales\Http\Controllers';

    /**
     * @return void
     */
    public function boot()
    {
        $this->mapRoutes();
    }

    protected function mapRoutes()
    {
        if (file_exists(module_path('Sales', '/Routes/tenant.php'))) {
            Route::namespace(static::$controllerNamespace)
                ->group(module_path('Sales', '/Routes/tenant.php'));
        }
    }
}
