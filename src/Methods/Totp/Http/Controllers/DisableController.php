<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Controllers;

use BombenProdukt\Guardian\Methods\Totp\Events\TwoFactorAuthenticationDisabled;
use BombenProdukt\Guardian\Methods\Totp\Http\Responses\DisabledResponse;
use Illuminate\Http\Request;

final class DisableController
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if (null !== $user->two_factor_secret || null !== $user->two_factor_recovery_codes || null !== $user->two_factor_confirmed_at) {
            $user->forceFill([
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
            ])->save();

            TwoFactorAuthenticationDisabled::dispatch($user);
        }

        return new DisabledResponse();
    }
}
