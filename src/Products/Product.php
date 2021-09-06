<?php

declare(strict_types=1);

namespace My\Products;

use My\Tables\Attributes\Table;
use My\Tables\Record;
use My\Tables\Attributes\DbColumn;
use My\Tables\Attributes\Filterable;
use My\Tables\Attributes\Searchable;
use My\Tables\Attributes\Sortable;

/**
 * @property string $sku #[
 *      DbColumn\String_, Filterable, Searchable, Sortable,
 * ]
 * @property string $description #[
 *      DbColumn\Data, Searchable,
 * ]
 */
#[Table('products')]
class Product extends Record
{

}