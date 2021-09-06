<?php

declare(strict_types=1);

namespace My\Tools\Tables;

use My\Tools\Tables\Hints\Property;
use Osm\Core\Object_;

/**
 * @property Property $property
 * @property string $index_field_fluent_calls
 */
class ColumnGenerator extends Object_
{
    public function generateTableColumn(): string {
        return <<<EOT
            \$this->tableColumn_{$this->property->name}(\$table);\n
EOT;
    }

    public function generateIndexField(): string {
        return <<<EOT
            \$this->indexField_{$this->property->name}(\$index);\n
EOT;
    }

    public function generateTableColumnMethod(): string {
        return <<<EOT
    protected function tableColumn_{$this->property->name}(TableBlueprint \$table): void {
    }\n\n
EOT;
    }

    public function generateIndexFieldMethod(): string {
            return <<<EOT
    protected function indexField_{$this->property->name}(IndexBlueprint \$index): void {
    }\n\n
EOT;
    }

    protected function get_index_field_fluent_calls(): string {
        $fluentCalls = '';

        if ($this->property->faceted) {
            $fluentCalls .= "\n            ->faceted()";
        }

        if ($this->property->filterable) {
            $fluentCalls .= "\n            ->filterable()";
        }

        if ($this->property->searchable) {
            $fluentCalls .= "\n            ->searchable()";
        }

        if ($this->property->sortable) {
            $fluentCalls .= "\n            ->sortable()";
        }

        return $fluentCalls;
    }
}