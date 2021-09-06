<?php

declare(strict_types=1);

namespace My\Products;

use My\Tables\Attributes\Table;
use My\Tables\Record;
use My\Tables\Attributes\DbColumn;
use My\Tables\Attributes\Filterable;
use My\Tables\Attributes\Searchable;
use My\Tables\Attributes\Sortable;
use My\Tables\Attributes\Field;
use My\Tables\Attributes\Column;

/**
 * @property string $sku #[
 *      DbColumn\String_, Filterable, Searchable, Sortable,
 *      Field\String_('SKU'), Column
 * ]
 * @property string $description #[
 *      DbColumn\Data, Searchable,
 *      Field\Text('Description'), Column
 * ]
 */
#[Table('products')]
class Product extends Record
{

}