<?php

declare(strict_types=1);

namespace My\Tables\Attributes\Field;

use My\Tables\Attributes\Field;

/**
 * Column's value is edited in a text area
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Text extends Field
{
    public string $type = 'text';
}