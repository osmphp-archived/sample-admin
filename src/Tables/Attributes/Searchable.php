<?php

declare(strict_types=1);

namespace My\Tables\Attributes;

/**
 * Column is searched via collection search
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Searchable extends Migrated
{

}