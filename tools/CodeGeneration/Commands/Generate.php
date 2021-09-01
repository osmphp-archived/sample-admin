<?php

declare(strict_types=1);

namespace My\Tools\CodeGeneration\Commands;

use My\Tools\CodeGeneration\Generator;
use My\Tools\CodeGeneration\Module;
use Osm\Core\App;
use Osm\Core\BaseModule;
use Osm\Framework\Console\Command;

/**
 * @property Module $module
 */
class Generate extends Command
{
    public string $name = 'generate';

    public function run(): void {
        foreach ($this->module->generator_class_names as $className) {
            $this->createGenerator($className)->run();


        }
    }

    protected function get_module(): BaseModule {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->modules[Module::class];
    }

    protected function createGenerator(string $className): Generator {
        $new = "{$className}::new";
        return $new(['output' => $this->output]);
    }
}