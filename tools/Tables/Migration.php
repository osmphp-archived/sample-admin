<?php

declare(strict_types=1);

namespace My\Tools\Tables;

use My\Tables\Attributes\Table;
use My\Tools\Tables\Hints\Class_;
use Osm\Core\Exceptions\NotImplemented;
use Osm\Core\Object_;

/**
 * @property Class_ $class
 * @property Table $table
 * @property bool $create
 *
 * @property string $base_filename
 * @property string $base_namespace
 * @property string $base_class_name
 * @property string $derived_filename
 * @property string $derived_namespace
 * @property string $derived_class_name
 */
class Migration extends Object_
{
    protected function get_base_filename(): string {
        return "{$this->class->module_path}/Generated/Migrations/" .
            "{$this->base_class_name}.php";
    }

    protected function get_base_namespace(): string {
        return "{$this->class->module_namespace}\\Generated\\Migrations";
    }

    protected function get_base_class_name(): string {
        return "M{$this->class->table->migration}_{$this->class->table->name}";
    }

    protected function get_derived_filename(): string {
        return "{$this->class->module_path}/Migrations/" .
            "{$this->base_class_name}.php";
    }

    protected function get_derived_namespace(): string {
        return "{$this->class->module_namespace}\\Migrations";
    }

    protected function get_derived_class_name(): string {
        return $this->base_class_name;
    }
}