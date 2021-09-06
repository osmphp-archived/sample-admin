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
            
            $this->tableColumn_sku($table);            
        });

        if ($this->search->exists('products')) {
            $this->search->drop('products');
        }

        $this->search->create('products', function (IndexBlueprint $index) {
            $this->indexField_sku($index);            
        });
    }

    public function drop(): void {
        $this->db->drop('products');
        $this->search->drop('products');
    }

    protected function tableColumn_sku(TableBlueprint $table): void {
        $table->string('sku');
    }
            
    protected function indexField_sku(IndexBlueprint $index): void {
        $index->string('sku')
            ->filterable()
            ->searchable()
            ->sortable();
    }
            
}
 