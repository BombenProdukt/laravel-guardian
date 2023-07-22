<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Responses;

use BombenProdukt\Guardian\Guardian;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

final class PassedSignInResponse implements Responsable
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function toResponse($request): Response
    {
        if ($request->wantsJson()) {
            return new JsonResponse(status: 204);
        }

        return Redirect::intended(Guardian::redirects('login'));
    }
}
