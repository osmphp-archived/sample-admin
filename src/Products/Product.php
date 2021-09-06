<?php

declare(strict_types=1);

namespace My\Products;

use My\Tables\Attributes\Table;
use My\Tables\Record;
use My\Tables\Attributes\Column;
use My\Tables\Attributes\Filterable;
use My\Tables\Attributes\Searchable;
use My\Tables\Attributes\Sortable;

/**
 * @property string $sku #[Column\String_, Filterable, Searchable, Sortable]
 * @property string $description #[Column\Data]
 */
#[Table('products')]
class Product extends Record
{

}