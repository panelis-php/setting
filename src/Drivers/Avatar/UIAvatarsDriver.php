<?php

namespace Panelis\Setting\Drivers\Avatar;

use Illuminate\Contracts\Auth\Authenticatable;
use Panelis\Setting\Drivers\AvatarDriver;

class UIAvatarsDriver extends AvatarDriver
{
    public const string NAME = 'ui-avatars';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return 'UI Avatars (ui-avatars.com)';
    }

    public function getImageUrl(Authenticatable $user, ?\BackedEnum $style = null): ?string
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($user->name ?? '');
    }
}
