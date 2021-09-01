<?php

declare(strict_types=1);

namespace My\Tools\Tables;

use My\Tools\CodeGeneration\Generator;
use Osm\Core\App;

class MigrationGenerator extends Generator
{
    public function run(): void {
        global $osm_app; /* @var App $osm_app */

        $this->output->writeln('Starting');
        foreach ($osm_app->project_modules as $module) {
            $this->output->writeln($module->name);
        }
    }
}