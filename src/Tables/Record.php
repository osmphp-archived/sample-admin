<?php

declare(strict_types=1);

namespace My\Tables;

use Osm\Core\Object_;
use My\Tables\Attributes\Column;

/**
 * @property int $id #[Column\Id]
 * @property ?\stdClass $data
 */
class Record extends Object_
{

}