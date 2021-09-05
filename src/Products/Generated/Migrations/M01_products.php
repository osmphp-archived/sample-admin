<?php

// THIS FILE IS GENERATED USING `osmt generate` COMMAND.
// DON'T EDIT OR DELETE THIS FILE.

namespace My\Products\Generated\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Osm\Core\App;
use Osm\Framework\Db\Db;
use Osm\Framework\Migrations\Migration;

/**
 * @property Db $db
 */
class M01_products extends Migration {
    protected function get_db(): Db {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->db;
    }

    public function create(): void {
        $this->db->create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->json('data')->nullable();
        });
    }

    public function drop(): void {
        $this->db->drop('products');
    }
}
 