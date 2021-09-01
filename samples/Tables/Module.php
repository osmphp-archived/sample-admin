<?php

declare(strict_types=1);

namespace My\Samples\Tables;

use My\Samples\App;
use Osm\Core\Attributes\Name;
use Osm\Core\BaseModule;

#[Name('sample-tables')]
class Module extends BaseModule
{
    public static ?string $app_class_name = App::class;
}