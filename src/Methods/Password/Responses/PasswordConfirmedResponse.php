<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Password\Http\Responses;

use BombenProdukt\Guardian\Guardian;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class PasswordConfirmedResponse implements Responsable
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function toResponse($request): Response
    {
        if ($request->wantsJson()) {
            return new JsonResponse(status: 201);
        }

        return redirect()->intended(Guardian::redirects('password-confirmation'));
    }
}
