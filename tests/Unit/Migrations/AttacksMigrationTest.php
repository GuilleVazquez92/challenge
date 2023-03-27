<?php

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AttacksMigrationTest extends TestCase
{

   
    public function testAttacksTypesTableMigration()
    {
        $this->artisan('migrate');

        $this->assertTrue(Schema::hasTable('attack_types'));

        $columns = Schema::getColumnListing('attack_types');
        $this->assertEquals(['id', 'description', 'power', 'created_at', 'updated_at'], $columns);
    }
}
