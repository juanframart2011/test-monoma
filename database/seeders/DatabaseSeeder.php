<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Lead;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        #$this->call(RoleSeeder::class);

        // Obtener el role_id para el rol 'manager'
        $managerRoleId = Role::where('name', 'manager')->first()->id;

        // Obtener el role_id para el rol 'agent'
        $agentRoleId = Role::where('name', 'agent')->first()->id;

        // Crear 5 usuarios managers
        User::factory()->count(5)->create([
            'role_id' => $managerRoleId,
        ]);

        // Crear 10 usuarios agents
        User::factory()->count(10)->create([
            'role_id' => $agentRoleId,
        ]);

        // Crear 50 candidatos (leads) con propietarios agents y creados por managers
        Lead::factory()->count(50)->create();
    }
}
