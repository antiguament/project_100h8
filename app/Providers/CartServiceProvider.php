<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('cart', function ($app) {
            return new \App\Services\CartService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Compartir la cantidad de ítems en el carrito con todas las vistas
        View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $view->with('cartCount', count($cart));
        });
    }
}
