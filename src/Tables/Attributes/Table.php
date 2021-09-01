<?php

declare(strict_types=1);

namespace My\Tables\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class Table
{
    public function __construct(public string $table_name,
        public string $migration = '01')
    {
    }
}