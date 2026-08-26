<?php

namespace Panelis\Setting\Drivers\Avatar;

use Illuminate\Contracts\Auth\Authenticatable;
use Panelis\Setting\Drivers\AvatarDriver;

class GravatarDriver extends AvatarDriver
{
    public const string NAME = 'gravatar';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return 'Gravatar (gravatar.com)';
    }

    public function getImageUrl(Authenticatable $user, ?\BackedEnum $style = null): ?string
    {
        return sprintf('https://gravatar.com/avatar/%s', hash('sha256', (string) $user->email));
    }
}
