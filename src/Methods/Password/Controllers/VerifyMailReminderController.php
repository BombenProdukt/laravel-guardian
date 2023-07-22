<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Password\Http\Controllers;

use BombenProdukt\Guardian\Guardian;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class VerifyMailReminderController
{
    public function __invoke(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(Guardian::redirects('verification-link-sent'));
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification-link-sent']);
    }
}
