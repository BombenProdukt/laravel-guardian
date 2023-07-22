<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Password\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

final class FailedPasswordConfirmationResponse implements Responsable
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function toResponse($request): Response
    {
        $message = __('The provided password was incorrect.');

        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'password' => [$message],
            ]);
        }

        return back()->withErrors(['password' => $message]);
    }
}
