<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

final class RecoveryCodeReplaced
{
    use SerializesModels;

    public function __construct(
        public readonly Authenticatable $user,
        public readonly string $code,
    ) {}
}
