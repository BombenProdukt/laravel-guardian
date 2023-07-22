<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Controllers;

use Illuminate\Http\Request;

final class RecoveryCodeController
{
    public function __invoke(Request $request)
    {
        if (!$request->user()->two_factor_secret
            || !$request->user()->two_factor_recovery_codes) {
            return [];
        }

        return response()->json(\json_decode(decrypt(
            $request->user()->two_factor_recovery_codes,
        ), true));
    }
}
