<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

final class Guardian
{
    public static function username(): string
    {
        return Config::get('guardian.credentials.username');
    }

    public static function password(): string
    {
        return Config::get('guardian.credentials.password');
    }

    /**
     * @return class-string<Model>
     */
    public static function model(string $model): string
    {
        return Config::get("guardian.models.{$model}");
    }

    public static function redirects(string $route): string
    {
        return Config::get("guardian.redirects.{$route}");
    }

    public static function routes(): array
    {
        return Config::get('guardian.routes');
    }
}
