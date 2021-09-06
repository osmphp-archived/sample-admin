<?php

declare(strict_types=1);

namespace My\Tools\Tables\Hints;

use My\Tables\Attributes\DbColumn;
use My\Tables\Attributes\Faceted;
use My\Tables\Attributes\Filterable;
use My\Tables\Attributes\Searchable;
use My\Tables\Attributes\Sortable;

/**
 * @property string $name
 * @property string $type
 * @property bool $array
 * @property bool $nullable
 * @property DbColumn $column
 * @property ?Faceted $faceted
 * @property ?Filterable $filterable
 * @property ?Searchable $searchable
 * @property ?Sortable $sortable
 */
class Property
{

}