<?php

namespace Tests\Feature;

use App\Pack;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PackTest extends TestCase
{

    use RefreshDatabase;

    private $table = 'packs';


    /**
     * Test list of the packs.
     *
     * @return void
     */
    public function testPacksList()
    {
        $response = $this->get('/api/packs');
        $response->assertStatus(200);
        $response->assertJson([]);
    }

    /**
     * Test create a pack.
     *
     * @return void
     */
    public function testSuccessStorePack()
    {
        $pack = factory(Pack::class)->make()->only('name');
        $response = $this->postJson('/api/packs',$pack);
        $response->assertStatus(201);
        $response->assertJsonStructure(['message', 'pack']);
        $this->assertDatabaseHas($this->table, ['name' => $pack]);
    }

    /**
     * Test create a pack with no name.
     *
     * @return void
     */
    public function testFailStorePack()
    {
        $response = $this->postJson('/api/packs',[]);
        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
    }

    /**
     * Test showing a pack.
     *
     * @return void
     */
    public function testShowPack()
    {
        $packId = factory(Pack::class)->create()->only('id')['id'];
        $response = $this->get('/api/packs/'.$packId);
        $response->assertStatus(200);
        $response->assertJson([]);
    }

    /**
     * Test showing a  non existing pack.
     *
     * @return void
     */
    public function testShowNonExistingPack()
    {
        $response = $this->get('/api/packs/'.'12asdf');
        $response->assertStatus(404);
        $response->assertJson([]);
    }

    /**
     * Test updating a whole pack.
     *
     * @return void
     */
    public function testUpdatePack()
    {
        $pack = factory(Pack::class)->create();
        $newPack = factory(Pack::class )->make()->only(['name']);
        $response = $this->put('/api/packs/'.$pack->id, $newPack);
        $response->assertStatus(200);
        $response->assertJson(['pack' => $newPack]);
    }

    /**
     * Test deleting a whole pack.
     *
     * @return void
     */
    public function testDeletePack()
    {
        $pack = factory(Pack::class)->create();
        $response = $this->delete('/api/packs/'.$pack->id);
        $response->assertStatus(200);
        $response->assertJson([]);
        $this->assertSoftDeleted($this->table, ['id' => $pack->id]);
    }

}
