<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian;

enum AuthenticationState: string
{
    case PasswordUpdated = 'password-updated';

    case ProfileInformationUpdated = 'profile-information-updated';

    case RecoveryCodesGenerated = 'recovery-codes-generated';

    case TwoFactorAuthenticationConfirmed = 'two-factor-authentication-confirmed';

    case TwoFactorAuthenticationDisabled = 'two-factor-authentication-disabled';

    case TwoFactorAuthenticationEnabled = 'two-factor-authentication-enabled';

    case VerificationLinkSent = 'verification-link-sent';
}
