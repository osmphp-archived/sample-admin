<?php

declare(strict_types=1);

namespace My\Tools\Tables;

use My\Tables\Attributes\DbColumn;
use My\Tables\Attributes\Faceted;
use My\Tables\Attributes\Filterable;
use My\Tables\Attributes\Searchable;
use My\Tables\Attributes\Sortable;
use My\Tables\Attributes\Table;
use My\Tools\Tables\Hints\Class_;
use My\Tools\Tables\Hints\Property;
use Osm\Core\BaseModule;
use Osm\Core\Exceptions\NotImplemented;
use Osm\Core\Exceptions\NotSupported;
use Osm\Core\Object_;
use Osm\Project\App;
use function Osm\__;

/**
 * Extracts classes of this package marked with `Table` attribute.
 * Execute an instance of this class in context of `Osm_Project` application,
 * and let it be garbage-collected afterwards.
 *
 * @property Class_ $classes
 * @property BaseModule[] $project_modules
 * @property string $project_package_name
 */
class ClassExtractor extends Object_
{
    protected function get_classes(): array {
        global $osm_app; /* @var App $osm_app */

        $classes = [];

        foreach ($osm_app->classes as $class) {
            if (!($module = $this->getClassModule($class))) {
                continue;
            }

            if (isset($class->attributes[Table::class])) {
                $classes[$class->name] = $this->extractClass($module, $class);
            }
        }

        return $classes;
    }

    protected function getClassModule(\Osm\Core\Class_ $class): ?BaseModule {
        foreach ($this->project_modules as $module) {
            if (str_starts_with($class->name, "{$module->namespace}\\")) {
                return $module;
            }
        }

        return null;
    }

    protected function get_project_modules(): array {
        global $osm_app; /* @var App $osm_app */

        return array_filter($osm_app->modules,
            fn(BaseModule $module) =>
                $module->package_name === $this->project_package_name);
    }

    protected function get_project_package_name(): string {
        global $osm_app; /* @var App $osm_app */

        foreach ($osm_app->packages as $package) {
            if (!$package->path) {
                return $package->name;
            }
        }

        throw new NotSupported(__("One of the application packages should be the project package, the project's `composer.json`"));
    }

    protected function extractClass(BaseModule $module, \Osm\Core\Class_ $class)
        : \stdClass|Class_
    {
        return (object)[
            'name' => $class->name,
            'table' => $class->attributes[Table::class],
            'module_namespace' => $module->namespace,
            'module_path' => $module->path,
            'properties' => $this->extractProperties($class),
        ];
    }

    protected function extractProperties(\Osm\Core\Class_ $class): array {
        $properties = [];

        foreach ($class->properties as $property) {
            if ($column = $this->getColumnAttribute($property)) {
                $properties[$property->name] = $this->extractProperty($property,
                    $column);
            }

        }

        return $properties;
    }

    protected function getColumnAttribute(\Osm\Core\Property $property): ?DbColumn {
        foreach ($property->attributes as $attribute) {
            if ($attribute instanceof DbColumn) {
                return $attribute;
            }
        }

        return null;
    }

    protected function extractProperty(\Osm\Core\Property $property,
        DbColumn $column): \stdClass|Property
    {
        return (object)[
            'name' => $property->name,
            'type' => $property->type,
            'array' => $property->array,
            'nullable' => $property->nullable,
            'column' => $column,
            'faceted' => $property->attributes[Faceted::class] ?? null,
            'filterable' => $property->attributes[Filterable::class] ?? null,
            'searchable' => $property->attributes[Searchable::class] ?? null,
            'sortable' => $property->attributes[Sortable::class] ?? null,
        ];
    }
}