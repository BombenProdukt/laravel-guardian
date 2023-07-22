<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Controllers;

use Illuminate\Http\Request;

final class ActivationSecretController
{
    public function __invoke(Request $request)
    {
        if (null === $request->user()->two_factor_secret) {
            abort(404, 'Two factor authentication has not been enabled.');
        }

        return response()->json([
            'secretKey' => decrypt($request->user()->two_factor_secret),
        ]);
    }
}
