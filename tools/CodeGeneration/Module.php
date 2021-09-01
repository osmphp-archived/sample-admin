<?php

declare(strict_types=1);

namespace My\Tools\CodeGeneration;

use Osm\Core\BaseModule;
use Osm\Core\Class_;
use Osm\Tools\App;
use function Osm\get_descendant_classes;
use Osm\Framework\Cache\Attributes\Cached;

/**
 * @property string[] $generator_class_names #[Cached('generator_class_names')]
 */
class Module extends BaseModule
{
    public static ?string $app_class_name = App::class;

    protected function get_generator_class_names(): array {
        return array_map(fn(Class_ $class) => $class->name,
            get_descendant_classes(Generator::class));
    }
}