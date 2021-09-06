<?php

declare(strict_types=1);

namespace My\Tables\Attributes\Column;

use My\Tables\Attributes\Column;

/**
 * Column's value is stored as a property in the `data` column
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Data extends Column
{
    public string $type = 'data';
}