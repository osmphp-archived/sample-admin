<?php

declare(strict_types=1);

namespace My\Tools\Tables\ColumnGenerator;

use My\Tools\Tables\ColumnGenerator;
use Osm\Core\Attributes\Name;
use Osm\Core\Exceptions\NotSupported;
use function Osm\__;

#[Name('string')]
class String_ extends ColumnGenerator
{
    public function generateTableColumnMethod(): string {
        if ($this->property->type !== 'string') {
            throw new NotSupported(__("'DbColumn\\String_' properties should have 'string' type"));
        }

        $fluentCalls = '';

        if ($this->property->nullable) {
            $fluentCalls .= "\n            ->nullable()";
        }

        return <<<EOT
    protected function tableColumn_{$this->property->name}(TableBlueprint \$table): void {
        \$table->string('{$this->property->name}'){$fluentCalls};
    }\n\n
EOT;
    }

    public function generateIndexFieldMethod(): string {
        if (!$this->index_field_fluent_calls) {
            return parent::generateIndexFieldMethod();
        }

        return <<<EOT
    protected function indexField_{$this->property->name}(IndexBlueprint \$index): void {
        \$index->string('{$this->property->name}'){$this->index_field_fluent_calls};
    }\n\n
EOT;
    }
}