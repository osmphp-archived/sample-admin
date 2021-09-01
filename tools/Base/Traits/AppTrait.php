<?php

declare(strict_types=1);

namespace My\Tools\Base\Traits;

use Osm\Core\BaseModule;
use Osm\Runtime\Apps;
use Osm\Runtime\Compilation\Compiler;
use Osm\Tools\App;
use Osm\Framework\Cache\Attributes\Cached;

/**
 * @property string $project_package_name #[Cached('project_package_name')]
 * @property BaseModule[] $all_modules #[Cached('all_modules')]
 * @property BaseModule[] $project_modules
 */
trait AppTrait
{
    protected function get_all_modules(): array {
        $this->loadAllModules();

        return $this->all_modules;
    }

    protected function get_project_package_name(): string {
        $this->loadAllModules();

        return $this->project_package_name;
    }

    protected function loadAllModules(): void {
        $compiler = Compiler::new(['app_class_name' => App::class]);


        Apps::run($compiler, function (Compiler $compiler) {
            $modules = [];

            foreach ($compiler->app->unsorted_modules as $module) {
                $modules[$module->name] = $module->serialize();
            }

            $this->all_modules = $modules;
            $this->project_package_name = $compiler->app->composer_json->name;
        });
    }

    protected function get_project_modules(): array {
        return array_filter($this->all_modules, fn(BaseModule $module) =>
            $module->package_name === $this->project_package_name);
    }
}