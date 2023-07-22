<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Controllers;

use Illuminate\Http\Request;

final class ActivationCodeController
{
    public function __invoke(Request $request)
    {
        if (null === $request->user()->two_factor_secret) {
            return [];
        }

        return response()->json([
            'svg' => $request->user()->twoFactorQrCodeSvg(),
            'url' => $request->user()->twoFactorQrCodeUrl(),
        ]);
    }
}
