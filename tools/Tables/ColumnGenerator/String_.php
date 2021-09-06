<?php

declare(strict_types=1);

namespace My\Tools\Tables\ColumnGenerator;

use My\Tools\Tables\ColumnGenerator;
use Osm\Core\Attributes\Name;

#[Name('string')]
class String_ extends ColumnGenerator
{
    public function generateTableColumn(): string {
        return <<<EOT
            \$this->tableColumn_{$this->property->name}(\$table);
EOT;
    }

    public function generateIndexField(): string {
        return '';
    }

    public function generateTableColumnMethod(): string {
        $fluentCalls = '';

        if ($this->property->nullable) {
            $fluentCalls .= "\n            ->nullable()";
        }

        return <<<EOT
    protected function tableColumn_{$this->property->name}(TableBlueprint \$table): void {
        \$table->string('{$this->property->name}'){$fluentCalls};
    }

EOT;
    }

    public function generateIndexFieldMethod(): string {
        return '';
    }
}