<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Lead;
use App\Models\User;

class LeadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_leads_for_a_manager()
    {
        // Crear un usuario manager y loguearlo
        $manager = User::factory()->create(['role' => 'manager']);
        $this->actingAs($manager, 'api');

        // Crear 10 leads
        Lead::factory()->count(10)->create();

        // Hacer la petición para obtener los leads
        $response = $this->getJson('/api/leads');

        // Verificar que la respuesta tiene éxito
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }
}
