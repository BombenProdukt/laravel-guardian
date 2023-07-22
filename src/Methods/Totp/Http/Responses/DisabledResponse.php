<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Responses;

use BombenProdukt\Guardian\AuthenticationState;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class DisabledResponse implements Responsable
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function toResponse($request): Response
    {
        if ($request->wantsJson()) {
            return new JsonResponse(status: 200);
        }

        return redirect()->back()->with('status', AuthenticationState::TwoFactorAuthenticationDisabled->value);
    }
}
