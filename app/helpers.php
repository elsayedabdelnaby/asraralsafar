<?php

use Illuminate\Support\Facades\App;

use Modules\UsersManagement\Entities\Permission;
use App\Http\Actions\Languages\GetLanguageByCode;
use App\Http\Actions\Languages\GetAllActiveLanguages;
use Illuminate\Support\Facades\Cache;

if (!function_exists('getAllLanguages')) {
    function getAllLanguages()
    {
        return (new GetAllActiveLanguages())->handle();
    }
}

if (!function_exists('getCurrentLanguage')) {
    function getCurrentLanguage()
    {
        return (new GetLanguageByCode)->handle(App::getLocale());
    }
}

if (!function_exists('getMainLanguage')) {
    function getMainLanguage()
    {
        return (new GetLanguageByCode)->handle(env('APP_LOCALE'));
    }
}

if (!function_exists('getSystemPermissions')) {
    function getSystemPermissions()
    {
        return Cache::rememberForever('system_permissions', function () {
            return Permission::select('id', 'name', 'model_id', 'module_id')->get();
        });
    }
}


/**
 * Get all centeral domains.
 *
 * @return array
 */
if (!function_exists('centralDomains')) {
    function centralDomains(): array
    {
        return config('tenancy.central_domains');
    }
}
