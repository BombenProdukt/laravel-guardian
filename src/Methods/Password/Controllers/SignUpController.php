<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Password\Http\Controllers;

use BombenProdukt\Guardian\Guardian;
use BombenProdukt\Guardian\Methods\Password\Http\Requests\SignUpRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class SignUpController
{
    public function __invoke(SignUpRequest $request): Response
    {
        $user = App::call(
            [Guardian::model('user'), 'create'],
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ],
        );

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
