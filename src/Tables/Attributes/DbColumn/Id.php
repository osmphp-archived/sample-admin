<?php

declare(strict_types=1);

namespace My\Tables\Attributes\DbColumn;

use My\Tables\Attributes\DbColumn;

/**
 * Column's value is stored in the `id` column
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Id extends DbColumn
{
    public string $type = 'id';
}