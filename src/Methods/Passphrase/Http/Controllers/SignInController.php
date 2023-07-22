<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Passphrase\Http\Controllers;

use BombenProdukt\Guardian\Methods\Passphrase\Enums\AuthSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\LoginResponse;

final class SignInController
{
    public function __invoke(Request $request)
    {
        if (Session::get(AuthSession::PASSPHRASE_EXPIRATION) < Carbon::now()->timestamp) {
            Auth::logout();

            $this->clearSession($request);

            return redirect()
                ->route('login')
                ->withErrors(['passphrase' => ['Your passphrase has expired.']]);
        }

        if ($request->get('passphrase') !== Session::get(AuthSession::PASSPHRASE)) {
            throw ValidationException::withMessages([
                'passphrase' => ['The given passphrase is invalid.'],
            ]);
        }

        $this->clearSession($request);

        return resolve(LoginResponse::class);
    }

    private function clearSession($request): void
    {
        $request->session()->forget(AuthSession::PASSPHRASE);
        $request->session()->forget(AuthSession::PASSPHRASE_EXPIRATION);
    }
}
