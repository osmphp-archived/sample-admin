<?php

declare(strict_types=1);

namespace My\Tools\Tables;

use My\Tools\CodeGeneration\Generator;
use My\Tools\Tables\Hints\Class_;
use Osm\Core\App;
use Osm\Core\Exceptions\NotImplemented;
use Osm\Runtime\Apps;
use function Osm\__;
use function Osm\make_dir_for;

/**
 * @property Class_[] $classes Classes of this package marked with `Table` attribute
 * @property Migration[] $migrations
 */
class MigrationGenerator extends Generator
{
    public function generate(): void {
        global $osm_app; /* @var App $osm_app */

        foreach ($this->migrations as $migration) {
            $this->generateMigration($migration);
        }
    }

    protected function generateMigration(Migration $migration): void {
        $this->generateBaseMigration($migration);
        $this->generateDerivedMigration($migration);
    }

    protected function generateBaseMigration(Migration $migration): void {
        $this->generateFile($migration->base_filename, <<<EOT
<?php

// THIS FILE IS GENERATED USING `osmt generate` COMMAND.
// DON'T EDIT OR DELETE THIS FILE.

namespace {$migration->base_namespace};

use Illuminate\Database\Schema\Blueprint as TableBlueprint;
use Osm\Core\App;
use Osm\Framework\Db\Db;
use Osm\Framework\Migrations\Migration;
use Osm\Framework\Search\Blueprint as IndexBlueprint;
use Osm\Framework\Search\Search;

/**
 * @property Db \$db
 * @property Search \$search
 */
class {$migration->base_class_name} extends Migration {
    protected function get_db(): Db {
        global \$osm_app; /* @var App \$osm_app */

        return \$osm_app->db;
    }

    protected function get_search(): Search {
        global \$osm_app; /* @var App \$osm_app */

        return \$osm_app->search;
    }

    public function create(): void {
        \$this->db->create('{$migration->table->name}', function (TableBlueprint \$table) {
            \$table->increments('id');
            \$table->json('data')->nullable();
        });

        if (\$this->search->exists('{$migration->table->name}')) {
            \$this->search->drop('{$migration->table->name}');
        }

        \$this->search->create('{$migration->table->name}', function (IndexBlueprint \$index) {
        });
    }

    public function drop(): void {
        \$this->db->drop('{$migration->table->name}');
        \$this->search->drop('{$migration->table->name}');
    }
}
 
EOT);
    }

    protected function generateDerivedMigration(Migration $migration): void {
        $this->generateFile($migration->derived_filename, <<<EOT
<?php

namespace {$migration->derived_namespace};

use {$migration->base_namespace}\\{$migration->base_class_name} as BaseMigration;

class {$migration->derived_class_name} extends BaseMigration {
}
 
EOT, preserve: true);
    }

    protected function get_migrations(): array {
        $migrations = [];

        foreach ($this->classes as $class) {
            $migrations = array_merge($migrations,
                $this->extractClassMigrations($class));
        }

        return $migrations;
    }

    protected function get_classes(): array {
        return Apps::run(Apps::create(\Osm\Project\App::class),
            fn() => ClassExtractor::new()->classes);
    }

    protected function extractClassMigrations(\stdClass|Class_ $class): array {
        $migrations = [$class->table->migration => Migration::new([
            'class' => $class,
            'table' => $class->table,
            'create' => true,
        ])];

        // TODO prepare ALTER TABLE migrations

        return array_values($migrations);
    }

    protected function generateFile(string $filename, string $contents,
        bool $preserve = false): void
    {
        $exists = is_file($filename);
        if ($exists && $preserve) {
            $this->output->writeln(__("':file' skipped",
                ['file' => $filename]));
            return;
        }

        file_put_contents(make_dir_for($filename), $contents);
        $this->output->writeln($exists
            ? __("':file' updated", ['file' => $filename])
            : __("':file' created", ['file' => $filename]));
    }
}