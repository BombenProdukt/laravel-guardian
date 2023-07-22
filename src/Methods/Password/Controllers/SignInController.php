<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Password\Http\Controllers;

use BombenProdukt\Guardian\Methods\Password\Http\Requests\SignInRequest;
use Illuminate\Http\Response;

final class SignInController
{
    public function __invoke(SignInRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }
}
