<?php

declare(strict_types=1);

namespace My\Tables\Attributes\DbColumn;

/**
 * Column's value is stored in a dedicated table `varchar` column
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class String_ extends Dedicated
{
    public string $type = 'string';
}