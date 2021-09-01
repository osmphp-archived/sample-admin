<?php

declare(strict_types=1);

namespace My\Tools\CodeGeneration;

use Osm\Core\Object_;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @property OutputInterface $output
 */
class Generator extends Object_
{
    public function run(): void {

    }

    protected function get_output(): OutputInterface {
        // if output stream is not provided by the caller, write output to a
        // memory buffer
        return new BufferedOutput();
    }
}