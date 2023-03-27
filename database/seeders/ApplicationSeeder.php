<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PlayerType;
use App\Models\ItemType;
use App\Models\AttackType;
use App\Models\Player;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CREATE ROLES

        $admiRole       = Role::create(['name' => 'admin']);
        $playerRole     = Role::create(['name' => 'player']);

        // CREATE AND ASSIGN PERMISSIONS

        $permission = Permission::create(['name' => 'player_types.index'])->syncRoles([$admiRole, $playerRole]);
        $permission = Permission::create(['name' => 'player_types.show'])->assignRole($admiRole);
        $permission = Permission::create(['name' => 'player_types.store'])->assignRole($admiRole);
        $permission = Permission::create(['name' => 'player_types.update'])->assignRole($admiRole);
        $permission = Permission::create(['name' => 'player_types.delete'])->assignRole($admiRole);
        
        // USERS CREATE
        //User::factory(10)->create();
        User::factory(10)->create()->each(function ($user) use ($playerRole) {
            $user->assignRole($playerRole);
        });

        User::create([
            'name'      => 'Administrador',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('SoluAdmin2023'),
        ])->assignRole('admin');

        // PLAYERS TYPE CREATE
        PlayerType::factory()->create([
            'description'  => 'Humano',
        ]);

        PlayerType::factory()->create([
            'description'  => 'Zombie',
        ]);

        // ITEMS TYPE CREATE
        ItemType::factory()->create([
            'description'  => 'Bota',
        ]);

        ItemType::factory()->create([
            'description'  => 'Armadura',
        ]);
        ItemType::factory()->create([
            'description'  => 'Arma',
        ]);

        // ATTACKS TYPE

        AttackType::factory()->create([
            'description'  => 'Cuerpo a cuerpo',
            'power'         => 1
        ]);

        AttackType::factory()->create([
            'description'  => 'A distancia',
            'power'         => 0.8
        ]);
        AttackType::factory()->create([
            'description'  => 'Ulti',
            'power'         => 2
        ]);

        // CREATE PLAYERS

        Player::factory(10)->create();
    }
}
