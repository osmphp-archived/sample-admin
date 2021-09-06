<?php

// THIS FILE IS GENERATED USING `osmt generate` COMMAND.
// DON'T EDIT OR DELETE THIS FILE.

namespace My\Products\Generated\Migrations;

use Illuminate\Database\Schema\Blueprint as TableBlueprint;
use Osm\Core\App;
use Osm\Framework\Db\Db;
use Osm\Framework\Migrations\Migration;
use Osm\Framework\Search\Blueprint as IndexBlueprint;
use Osm\Framework\Search\Search;

/**
 * @property Db $db
 * @property Search $search
 */
class M01_products extends Migration {
    protected function get_db(): Db {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->db;
    }

    protected function get_search(): Search {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->search;
    }

    public function create(): void {
        $this->db->create('products', function (TableBlueprint $table) {
            $table->increments('id');
            $table->json('data')->nullable();
            
            $this->tableColumn_id($table);
            $this->tableColumn_sku($table);
            $this->tableColumn_description($table);
            
        });

        if ($this->search->exists('products')) {
            $this->search->drop('products');
        }

        $this->search->create('products', function (IndexBlueprint $index) {
            $this->indexField_id($index);
            $this->indexField_sku($index);
            $this->indexField_description($index);
            
        });
    }

    public function drop(): void {
        $this->db->drop('products');
        $this->search->drop('products');
    }

    protected function tableColumn_id(TableBlueprint $table): void {
    }

    protected function tableColumn_sku(TableBlueprint $table): void {
        $table->string('sku');
    }

    protected function tableColumn_description(TableBlueprint $table): void {
    }

            
    protected function indexField_id(IndexBlueprint $index): void {
    }

    protected function indexField_sku(IndexBlueprint $index): void {
        $index->string('sku')
            ->filterable()
            ->searchable()
            ->sortable();
    }

    protected function indexField_description(IndexBlueprint $index): void {
        $index->string('description')
            ->searchable();
    }

            
}
 