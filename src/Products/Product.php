<?php

declare(strict_types=1);

namespace My\Products;

use My\Tables\Attributes\Table;
use My\Tables\Record;
use My\Tables\Attributes\Column;

/**
 * @property string $sku #[Column\String_]
 * @property string $description #[Column\Data]
 */
#[Table('products')]
class Product extends Record
{

}