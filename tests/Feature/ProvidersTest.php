<?php

namespace Tests\Feature;

use App\Provider;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProvidersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_can_create_a_provider()
    {
        $user = factory(User::class)->create();

        Sanctum::actingAs($user);

        $response = $this->post('/api/providers', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'payment' => $this->faker->numerify("###.##")
        ]);

        $response
        ->assertCreated()
        ->assertJsonStructure([
                        'id',
                        'user_id',
                        'name',
                        'email',
                        'payment',
                        'created_at',
                        'updated_at'
                    ]);
    }

    public function test_it_can_not_create_a_provider()
    {
        $user = factory(User::class)->create();

        Sanctum::actingAs($user);

        $response = $this->post('/api/providers', [
            'name' => $this->faker->name,
            'payment' => $this->faker->numerify("###.##")
        ], [
            'Accept' => 'application/json'
        ]);

        $response
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => [
                'email'
            ]
        ]);
    }

    public function test_it_can_list_a_users_providers()
    {
        $user = factory(User::class)->create();

        Sanctum::actingAs($user);

        $response = $this->get('/api/providers');

        $response->assertOk();
    }

    public function test_it_can_delete_a_user_provider()
    {
        $user = factory(User::class)->create();

        Sanctum::actingAs($user);

        $provider = factory(Provider::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->delete("/api/providers/{$provider->id}");

        $response
        ->assertOk()
        ->assertSee(1);
    }
}
