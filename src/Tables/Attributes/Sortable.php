<?php

declare(strict_types=1);

namespace My\Tables\Attributes;

/**
 * Column can be used in collection sorting
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Sortable extends Migrated
{

}