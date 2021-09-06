<?php

declare(strict_types=1);

namespace My\Tables\Attributes;

/**
 * @property string $type Type name used to instantiate classes that do
 *      processing of column data.
 */
class Migrated
{
    public function __construct(public string $migration = '01') {
    }
}