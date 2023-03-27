<?php

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ItemTypesMigrationTest extends TestCase
{
    
    public function it_creates_item_types_table()
    {
        
        // Verificar si la tabla existe después de ejecutar la migración
        $this->assertTrue(Schema::hasTable('item_types'));

        // Verificar si las columnas esperadas existen en la tabla
        $this->assertTrue(Schema::hasColumns('item_types', [
            'id',
            'description',
            'created_at',
            'updated_at',
        ]));
    }
}
