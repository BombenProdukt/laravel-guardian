<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

final class FailedSignInResponse implements Responsable
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function toResponse($request): Response
    {
        [$key, $message] = $request->filled('recovery_code')
            ? ['recovery_code', __('The provided two factor recovery code was invalid.')]
            : ['code', __('The provided two factor authentication code was invalid.')];

        if ($request->wantsJson()) {
            throw ValidationException::withMessages([$key => [$message]]);
        }

        return Redirect::route('guardian.login')->withErrors([$key => $message]);
    }
}
