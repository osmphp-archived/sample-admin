<?php

declare(strict_types=1);

namespace My\Tables\Attributes\Field;

use My\Tables\Attributes\Field;

/**
 * Column's value is edited in a string input
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class String_ extends Field
{
    public string $type = 'string';
}