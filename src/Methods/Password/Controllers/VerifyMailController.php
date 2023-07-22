<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Password\Http\Controllers;

use BombenProdukt\Guardian\Guardian;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

final class VerifyMailController
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(Guardian::redirects('verification-link-sent'));
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(Guardian::redirects('verification-link-sent'));
    }
}
