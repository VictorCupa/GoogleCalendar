<?php

namespace App\Providers;
  
use Illuminate\Support\ServiceProvider;
use App\Library\Services\DemoOne;
  
class EnvatoCustomServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }
  
    public function register()
    {
        $this->app->bind('App\Library\Services\DemoOne', function ($app) {
          return new DemoOne();
        });
    }
}