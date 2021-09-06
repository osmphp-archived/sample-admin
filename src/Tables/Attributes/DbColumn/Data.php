<?php

declare(strict_types=1);

namespace My\Tables\Attributes\DbColumn;

use My\Tables\Attributes\DbColumn;

/**
 * Column's value is stored as a property in the `data` column
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Data extends DbColumn
{
    public string $type = 'data';
}