<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Controllers;

use BombenProdukt\Guardian\Methods\Totp\Events\RecoveryCodeReplaced;
use BombenProdukt\Guardian\Methods\Totp\Http\Requests\SignInRequest;
use BombenProdukt\Guardian\Methods\Totp\Http\Responses\FailedSignInResponse;
use BombenProdukt\Guardian\Methods\Totp\Http\Responses\PassedSignInResponse;
use Illuminate\Support\Facades\Auth;

final class SignInController
{
    public function __invoke(SignInRequest $request)
    {
        $user = $request->challengedUser();

        if ($code = $request->validRecoveryCode()) {
            $user->replaceRecoveryCode($code);

            event(new RecoveryCodeReplaced($user, $code));
        }

        if (!$request->hasValidCode()) {
            return new FailedSignInResponse();
        }

        Auth::login($user, $request->remember());

        $request->session()->regenerate();

        return new PassedSignInResponse();
    }
}
