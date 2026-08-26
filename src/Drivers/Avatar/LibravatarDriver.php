<?php

namespace Panelis\Setting\Drivers\Avatar;

use BackedEnum;
use Illuminate\Contracts\Auth\Authenticatable;
use Panelis\Setting\Drivers\AvatarDriver;

class LibravatarDriver extends AvatarDriver
{
    public const string NAME = 'libravatar';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return 'Libravatar (libravatar.org)';
    }

    public function getImageUrl(Authenticatable $user, ?BackedEnum $style = null): ?string
    {
        $style = $style?->value ?? config('user.avatar_libravatar_style', 'retro');

        return sprintf('https://www.libravatar.org/avatar/%s?s=80&forcedefault=y&default=%s', hash('sha256', (string) $user->email), $style);
    }
}
