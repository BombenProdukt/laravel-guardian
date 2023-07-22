<?php

declare(strict_types=1);

use BombenProdukt\Guardian\Methods\Password\Http\Controllers\ForgotPasswordController;
use BombenProdukt\Guardian\Methods\Password\Http\Controllers\ResetPasswordController;
use BombenProdukt\Guardian\Methods\Password\Http\Controllers\SignInController;
use BombenProdukt\Guardian\Methods\Password\Http\Controllers\SignOutController;
use BombenProdukt\Guardian\Methods\Password\Http\Controllers\SignUpController;
use BombenProdukt\Guardian\Methods\Password\Http\Controllers\VerifyMailController;
use BombenProdukt\Guardian\Methods\Password\Http\Controllers\VerifyMailReminderController;

return [
    'credentials' => [
        'username' => 'email',
        'password' => 'password',
    ],
    'models' => [
        'user' => 'App\Models\User',
    ],
    'multi-factor-authentication' => [
        'google-authenticator' => [
            'window' => 0,
        ],
    ],
    'redirects' => [
        'sign-up' => 'sign-up',
        'sign-in' => 'sign-in',
        'sign-out' => 'sign-out',
        'forgot-password' => 'forgot-password',
        'reset-password' => 'reset-password',
        'verify-mail' => 'verify-mail',
        'verify-mail-reminder' => 'verify-mail-reminder',
    ],
    'routes' => [
        [
            'name' => 'guardian.sign-up',
            'path' => '/sign-up',
            'middleware' => ['guest'],
            'controller' => SignUpController::class,
        ],
        [
            'name' => 'guardian.sign-in',
            'path' => '/sign-in',
            'middleware' => ['guest'],
            'controller' => SignInController::class,
        ],
        [
            'name' => 'guardian.sign-out',
            'path' => '/sign-out',
            'middleware' => ['auth'],
            'controller' => SignOutController::class,
        ],
        [
            'name' => 'guardian.forgot-password',
            'path' => '/forgot-password',
            'middleware' => ['guest'],
            'controller' => ForgotPasswordController::class,
        ],
        [
            'name' => 'guardian.reset-password',
            'path' => '/reset-password',
            'middleware' => ['guest'],
            'controller' => ResetPasswordController::class,
        ],
        [
            'name' => 'guardian.verify-mail',
            'path' => '/verify-email/{id}/{hash}',
            'middleware' => ['auth', 'signed', 'throttle:6,1'],
            'controller' => VerifyMailController::class,
        ],
        [
            'name' => 'guardian.verify-mail-reminder',
            'path' => '/verify-mail/reminder',
            'middleware' => ['auth', 'throttle:6,1'],
            'controller' => VerifyMailReminderController::class,
        ],
    ],
];
