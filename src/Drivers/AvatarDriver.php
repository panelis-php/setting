<?php

namespace Panelis\Setting\Drivers;

use BackedEnum;
use Illuminate\Contracts\Auth\Authenticatable;

abstract class AvatarDriver extends Driver
{
    abstract public function getImageUrl(Authenticatable $user, ?BackedEnum $style = null): ?string;
}
