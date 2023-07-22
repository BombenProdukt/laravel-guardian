<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian;

use Illuminate\Support\Facades\Route;

final class Routes
{
    public static function register(): void
    {
        foreach (Guardian::routes() as $route) {
            Route::post($route['path'], $route['controller'])
                ->middleware($route['middleware'])
                ->name($route['name']);
        }
    }
}
