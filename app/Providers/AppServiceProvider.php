<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\PersonalAccessToken;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {






        if ($this->app->environment('local')) {
            // $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            //$this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        //alias for morph relation
        Relation::enforceMorphMap([

            'user' => 'App\Models\User',
        ]);

        Relation::morphMap([
            'categories' => Category::class,

        ]);
    }
}
