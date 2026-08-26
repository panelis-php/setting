<?php

namespace Panelis\Setting\Drivers\Avatar;

use Illuminate\Contracts\Auth\Authenticatable;
use Panelis\Setting\Drivers\AvatarDriver;

class UnavatarDriver extends AvatarDriver
{
    public const string NAME = 'unavatar';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return 'Unavatar.io';
    }

    public function getImageUrl(Authenticatable $user, ?\BackedEnum $style = null): ?string
    {
        return 'https://unavatar.io/'.urlencode((string) $user->email);
    }
}
