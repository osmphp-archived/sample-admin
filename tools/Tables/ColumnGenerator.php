<?php

declare(strict_types=1);

namespace My\Tools\Tables;

use My\Tools\Tables\Hints\Property;
use Osm\Core\Object_;

/**
 * @property Property $property
 */
class ColumnGenerator extends Object_
{
    public function generateTableColumn(): string {
        return '';
    }

    public function generateIndexField(): string {
        return '';
    }

    public function generateTableColumnMethod(): string {
        return '';
    }

    public function generateIndexFieldMethod(): string {
        return '';
    }
}