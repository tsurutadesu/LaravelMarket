<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            'App\Http\ViewComposers\Layouts\LayoutComposer' => ['layouts.menubar', 'layouts.app'],
            'App\Http\ViewComposers\Layouts\AppComposer' => 'layouts.app',
            'App\Http\ViewComposers\Layouts\SliderComposer' => 'layouts.slider',
            'App\Http\ViewComposers\Main\MainComposer' => 'main.index',
            'App\Http\ViewComposers\Main\CheckoutComposer' => 'main.payment',
            'App\Http\ViewComposers\Main\StripeComposer' => 'main.checkout',
            'App\Http\ViewComposers\Auth\LoginComposer' => 'auth.login',
            'App\Http\ViewComposers\HomeComposer' => 'home',
        ]);
    }
}
