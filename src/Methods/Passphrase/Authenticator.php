<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Passphrase;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\URL;

final readonly class Authenticator
{
    public function createLink(Authenticatable $user): string
    {
        return URL::temporarySignedRoute('login.magic', now()->addMinutes(15), ['authIdentifier' => $user->getAuthIdentifier()]);
    }
}
