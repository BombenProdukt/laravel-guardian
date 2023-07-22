<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Totp;

use BombenProdukt\Guardian\Cotnracts\AuthenticatorInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Config;
use PragmaRX\Google2FA\Google2FA;

final class Authenticator implements AuthenticatorInterface
{
    public function __construct(
        private readonly Google2FA $engine,
        private readonly ?Repository $cache = null,
    ) {
        //
    }

    public function generateSecretKey(): string
    {
        return $this->engine->generateSecretKey();
    }

    public function qrCodeUrl(string $companyName, string $companyEmail, string $secret): string
    {
        return $this->engine->getQRCodeUrl($companyName, $companyEmail, $secret);
    }

    public function verify(string $secret, string $code): bool
    {
        if (\is_int($customWindow = Config::get('guardian.multi-factor-authentication.google-authenticator.window'))) {
            $this->engine->setWindow($customWindow);
        }

        $timestamp = $this->engine->verifyKeyNewer(
            $secret,
            $code,
            optional($this->cache)->get($key = 'guardian.mfa_codes.'.\md5($code)),
        );

        if ($timestamp !== false) {
            if ($timestamp === true) {
                $timestamp = $this->engine->getTimestamp();
            }

            optional($this->cache)->put($key, $timestamp, ($this->engine->getWindow() ?: 1) * 60);

            return true;
        }

        return false;
    }
}
