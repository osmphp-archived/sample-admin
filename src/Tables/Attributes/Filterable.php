<?php

declare(strict_types=1);

namespace My\Tables\Attributes;

/**
 * Column can be used in collection filters
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Filterable extends Column
{

}