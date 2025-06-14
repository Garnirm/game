<?php

namespace Tests\Feature\Save;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /** @test */
    public function create(): void
    {
        $request = $this->post('/save/create', [
            'people_name' => 'Test', 'save_name' => 'Unit test', 'difficulty' => 'normal', 'territory_growth' => 'normal',
            'wealth_resources' => 'normal', 'ia_density' => 'normal', 'initial_proximity' => 'normal', 'map_seed' => null,
            'first_city_name' => 'Test', 'player_trait_points' => 5, 'ia_trait_points' => 5,
        ]);

        $request->assertStatus(200);
        $request->assertJson([ 'success' => true ]);
    }
}