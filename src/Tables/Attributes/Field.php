<?php

declare(strict_types=1);

namespace My\Tables\Attributes;

/**
 * @property string $type Type name used to instantiate classes that do
 *      processing of the field data.
 */
class Field
{
    public function __construct(public string $title,
        public ?string $description = null)
    {
    }
}