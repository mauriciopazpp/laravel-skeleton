<?php namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class CarbonLanguageProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set( 'America/Sao_Paulo' );

        setlocale( LC_ALL, config('app.locale'), 'pt_BR.UTF-8', 'pt_BR.utf-8', 'portuguese');
        
        Carbon::setLocale(config('app.locale'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Carbon::setLocale($this->app->getLocale());
    }
}
