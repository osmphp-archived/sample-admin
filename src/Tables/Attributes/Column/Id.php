<?php

declare(strict_types=1);

namespace My\Tables\Attributes\Column;

use My\Tables\Attributes\Column;

/**
 * Column's value is stored in the `id` column
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Id extends Column
{
    public string $type = 'id';
}