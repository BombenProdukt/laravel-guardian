<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Controllers;

use BombenProdukt\Guardian\Methods\Totp\Events\RecoveryCodesGenerated;
use BombenProdukt\Guardian\Methods\Totp\Http\Responses\RecoveryCodesGeneratedResponse;
use BombenProdukt\Guardian\RecoveryCode;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

final class RecoveryCodeGeneratorController
{
    public function __invoke(Request $request)
    {
        $request->user()->forceFill([
            'two_factor_recovery_codes' => encrypt(\json_encode(Collection::times(8, function () {
                return RecoveryCode::generate();
            })->all())),
        ])->save();

        RecoveryCodesGenerated::dispatch($request->user());

        return new RecoveryCodesGeneratedResponse();
    }
}
