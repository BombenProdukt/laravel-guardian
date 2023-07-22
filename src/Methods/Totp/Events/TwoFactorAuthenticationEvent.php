<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;

abstract class TwoFactorAuthenticationEvent
{
    use Dispatchable;

    public function __construct(public readonly Authenticatable $user) {}
}
