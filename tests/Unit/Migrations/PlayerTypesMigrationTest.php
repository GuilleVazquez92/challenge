<?php

namespace Tests\Unit\Migrations;


use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PlayerTypesMigrationTest extends TestCase
{
   
    public function it_creates_player_types_table()
    {
        $this->assertTrue(Schema::hasTable('player_types')); // verifica si la tabla player_types ha sido creada

        $this->assertTrue(Schema::hasColumns('player_types', [
            'id',
            'description',
            'created_at',
            'updated_at',
        ])); // verifica si la tabla player_types contiene las columnas necesarias
    }
}