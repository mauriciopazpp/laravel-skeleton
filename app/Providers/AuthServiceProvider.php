<?php namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        Passport::routes();

        //uncomment if you need to expire the token
        #Passport::tokensExpireIn(Carbon::now()->addDays(15));

        //uncomment if you need to expire the token
        #Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
