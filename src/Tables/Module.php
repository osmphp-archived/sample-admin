<?php

declare(strict_types=1);

namespace My\Tables;

use Osm\App\App;
use Osm\Core\Attributes\Name;
use Osm\Core\BaseModule;

#[Name('tables')]
class Module extends BaseModule
{
    public static ?string $app_class_name = App::class;

    public static array $requires = [
        \My\Base\Module::class,
    ];
}