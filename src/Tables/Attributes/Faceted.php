<?php

declare(strict_types=1);

namespace My\Tables\Attributes;

/**
 * Column can be used in collection facet counting
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Faceted extends Migrated
{

}