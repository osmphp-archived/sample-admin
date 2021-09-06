<?php

declare(strict_types=1);

namespace My\Tables;

use Osm\Core\App;
use Osm\Core\Attributes\Name;
use Osm\Core\Class_;
use Osm\Core\Object_;
use Osm\Framework\Cache\Descendants;

/**
 * @property Descendants $descendants
 * @property Class_ $record_class
 */
class Query extends Object_
{
    protected function get_descendants(): Descendants {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->descendants;
    }

    protected function get_record_class(): Class_ {
        global $osm_app; /* @var App $osm_app */

        $name = $this->__class->properties[Name::class]->name;
        $className = $this->descendants->byName(Record::class)[$name];

        return $osm_app->classes[$className];
    }
}