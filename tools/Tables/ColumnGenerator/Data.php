<?php

declare(strict_types=1);

namespace My\Tools\Tables\ColumnGenerator;

use My\Tools\Tables\ColumnGenerator;
use Osm\Core\Attributes\Name;
use Osm\Core\Exceptions\NotImplemented;
use Osm\Core\Exceptions\NotSupported;
use function Osm\__;

/**
 * @property string $index_field_type
 */
#[Name('data')]
class Data extends ColumnGenerator
{
    public function generateIndexFieldMethod(): string {
        if (!$this->index_field_fluent_calls) {
            return parent::generateIndexFieldMethod();
        }

        return <<<EOT
    protected function indexField_{$this->property->name}(IndexBlueprint \$index): void {
        \$index->{$this->index_field_type}('{$this->property->name}'){$this->index_field_fluent_calls};
    }\n\n
EOT;
    }

    protected function get_index_field_type(): string {
        return match ($this->property->type) {
            'string' => 'string',
            default => throw new NotSupported(__("':type' record property can't be a part of the search index",
                ['type' => $this->property->type])),
        };
    }
}