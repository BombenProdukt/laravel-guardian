<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Password\Http\Controllers;

use BombenProdukt\Guardian\Methods\Password\Http\Responses\FailedPasswordConfirmationResponse;
use BombenProdukt\Guardian\Methods\Password\Http\Responses\PasswordConfirmedResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class ConfirmPasswordController
{
    public function __invoke(Request $request)
    {
        $confirmed = Auth::validate([
            'email' => $request->user()->email,
            'password' => $request->input('password'),
        ]);

        if ($confirmed) {
            return new PasswordConfirmedResponse();
        }

        return new FailedPasswordConfirmationResponse();
    }
}
