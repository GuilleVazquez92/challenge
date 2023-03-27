<?php

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AttackTypesMigrationTest extends TestCase
{

    public function testAttackTypesTableExists()
    {
        $this->assertTrue(Schema::hasTable('attack_types'));
    }

    public function testAttackTypesTableColumns()
    {
        $this->assertTrue(Schema::hasColumns('attack_types', [
            'id', 'description', 'power', 'created_at', 'updated_at'
        ]));
    }
}
