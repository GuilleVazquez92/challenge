<?php

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class PlayersMigrationTest extends TestCase
{


    public function test_players_table_is_created()
    {
        $this->assertTrue(Schema::hasTable('players'));
    }

 
    public function test_players_table_columns_are_correct()
    {
        $this->assertTrue(Schema::hasColumns('players', [
            'user_id',
            'player_type_id',
            'life',
            'attack_points',
            'defense_points',
            'created_at',
            'updated_at',
        ]));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_players_tabl_constraints()
    {
        $this->assertTrue(Schema::hasColumns('players', [
            'player_type_id'
        ]));
    }
}
