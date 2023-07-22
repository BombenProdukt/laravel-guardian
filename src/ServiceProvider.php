<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian;

use BombenProdukt\PackagePowerPack\Package\AbstractServiceProvider;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->singleton('laravel-guardian', fn () => new Guardian());
    }

    public function provides(): array
    {
        return ['laravel-guardian'];
    }
}
