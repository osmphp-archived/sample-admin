<?php

declare(strict_types=1);

namespace My\Tools\Base;

use Osm\Core\BaseModule;
use Osm\Tools\App;

class Module extends BaseModule
{
    public static ?string $app_class_name = App::class;
}