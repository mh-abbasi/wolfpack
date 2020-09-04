<?php

namespace Tests\Feature;

use App\Wolf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WolfTest extends TestCase
{
    use RefreshDatabase;

    private $table = 'wolves';

    /**
     * Test list of the wolves.
     *
     * @return void
     */
    public function testWolvesList()
    {
        $response = $this->get('/api/wolves');
        $response->assertStatus(200);
        $response->assertJson([]);
    }

    /**
     * Test create a wolf.
     *
     * @return void
     */
    public function testSuccessStoreWolf()
    {
        $wolf = factory(Wolf::class)->make()->only(['name','gender','birthdate','location']);
        $response = $this->postJson('/api/wolves',$wolf);
        $response->assertStatus(201);
        $response->assertJsonStructure(['message', 'wolf']);
        $this->assertDatabaseHas($this->table, ['name' => $wolf]);
    }

    /**
     * Test create a wolf with no data.
     *
     * @return void
     */
    public function testStoreWolfWithNoPayload()
    {
        $response = $this->postJson('/api/wolves',[]);
        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
    }

    /**
     * Test showing a wolf.
     *
     * @return void
     */
    public function testShowWolf()
    {
        $wolfId = factory(Wolf::class)->create()->only('id')['id'];
        $response = $this->get('/api/wolves/'.$wolfId);
        $response->assertStatus(200);
        $response->assertJson([]);
    }

    /**
     * Test showing a  non existing wolf.
     *
     * @return void
     */
    public function testShowNonExistingWolf()
    {
        $response = $this->get('/api/wolves/'.'12asdf');
        $response->assertStatus(404);
        $response->assertJson([]);
    }

    /**
     * Test updating a whole wolf.
     *
     * @return void
     */
    public function testUpdateWolf()
    {
        $wolf = factory(Wolf::class)->create();
        $newWolf = factory(Wolf::class )->make()->only(['name']);
        $response = $this->put('/api/wolves/'.$wolf->id, $newWolf);
        $response->assertStatus(200);
        $response->assertJson(['wolf' => $newWolf]);
    }

    /**
     * Test deleting a whole wolf.
     *
     * @return void
     */
    public function testDeleteWolf()
    {
        $wolf = factory(Wolf::class)->create();
        $response = $this->delete('/api/wolves/'.$wolf->id);
        $response->assertStatus(200);
        $response->assertJson([]);
        $this->assertSoftDeleted($this->table, ['id' => $wolf->id]);
    }
}
