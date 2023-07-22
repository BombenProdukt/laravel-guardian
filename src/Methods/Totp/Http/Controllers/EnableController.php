<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Controllers;

use BombenProdukt\Guardian\Contracts\AuthenticatorInterface;
use BombenProdukt\Guardian\Methods\Totp\Events\TwoFactorAuthenticationEnabled;
use BombenProdukt\Guardian\Methods\Totp\Http\Responses\EnabledResponse;
use BombenProdukt\Guardian\RecoveryCode;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

final class EnableController
{
    public function __construct(private readonly AuthenticatorInterface $authenticator) {}

    public function __invoke(Request $request)
    {
        $request->user()->forceFill([
            'two_factor_secret' => encrypt($this->authenticator->generateSecretKey()),
            'two_factor_recovery_codes' => encrypt(\json_encode(Collection::times(8, function () {
                return RecoveryCode::generate();
            })->all())),
        ])->save();

        TwoFactorAuthenticationEnabled::dispatch($request->user());

        return new EnabledResponse();
    }
}
