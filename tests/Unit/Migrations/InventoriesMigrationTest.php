<?php

namespace Tests\Unit\Migrations;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InventoriesMigrationTest extends TestCase
{


    public function test_iventories_table_exists()
    {
        $this->assertTrue(Schema::hasTable('inventories'));
    }

    public function test_inventories_table_has_expected_columns()
    {
        $columns = Schema::getColumnListing('inventories');

        $this->assertEquals(['id', 'player_id', 'item_id', 'equipped', 'created_at', 'updated_at'], $columns);
    }

    public function test_invetories_table_constraints()
    {
        $this->assertTrue(Schema::hasColumns('inventories', [
            'player_id'
        ]));

        $this->assertTrue(Schema::hasColumns('inventories', [
            'item_id'
        ]));
    }   

}

