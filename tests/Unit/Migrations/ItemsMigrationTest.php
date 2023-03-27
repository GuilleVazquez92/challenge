<?php

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ItemsMigrationTest extends TestCase
{
    

    public function testItemsTableExists()
    {
        $this->assertTrue(Schema::hasTable('items'));
    }

    public function testItemsTableHasColumns()
    {
        $this->assertTrue(Schema::hasColumns('items', [
            'id', 'name', 'item_type_id', 'defense_points', 'attack_points', 'created_at', 'updated_at'
        ]));
    }

    public function testItemsTableConstraints()
    {
        $this->assertTrue(Schema::hasColumns('items', [
            'item_type_id'
        ]));
    }
}
