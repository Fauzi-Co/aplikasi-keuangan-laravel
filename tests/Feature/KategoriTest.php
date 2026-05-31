<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Kategori;

class KategoriTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_success()
    {
        $res = $this->postJson('/api/kategori', ['nama' => 'eko']);
        $res->assertStatus(201)->assertJson(['data' => 'OK']);
        $this->assertDatabaseHas('kategori', ['name' => 'eko']);
    }

    public function test_store_duplicate()
    {
        Kategori::create(['name' => 'eko']);
        $res = $this->postJson('/api/kategori', ['nama' => 'eko']);
        $res->assertStatus(409)->assertJson(['error' => 'kategori Sudah Ada']);
    }

    public function test_index_returns_list()
    {
        Kategori::create(['name' => 'a']);
        Kategori::create(['name' => 'b']);
        $res = $this->getJson('/api/kategori');
        $res->assertStatus(200)->assertJsonStructure(['data' => [['id','name','created_at']]]);
        $this->assertCount(2, $res->json('data'));
    }

    public function test_delete_not_found()
    {
        $res = $this->deleteJson('/api/kategori/999');
        $res->assertStatus(404)->assertJson(['error' => 'kategori Tidak Ada']);
    }

    public function test_delete_success()
    {
        $k = Kategori::create(['name' => 'to-delete']);
        $res = $this->deleteJson('/api/kategori/' . $k->id);
        $res->assertStatus(200)->assertJson(['data' => 'OK']);
        $this->assertDatabaseMissing('kategori', ['id' => $k->id]);
    }

    public function test_update_success()
    {
        $k = Kategori::create(['name' => 'old']);
        $res = $this->putJson('/api/kategori/' . $k->id, ['nama' => 'new']);
        $res->assertStatus(200)->assertJson(['data' => 'OK']);
        $this->assertDatabaseHas('kategori', ['id' => $k->id, 'name' => 'new']);
    }

    public function test_update_duplicate()
    {
        Kategori::create(['name' => 'first']);
        $k2 = Kategori::create(['name' => 'second']);
        $res = $this->putJson('/api/kategori/' . $k2->id, ['nama' => 'first']);
        $res->assertStatus(409)->assertJson(['error' => 'kategori Sudah Ada']);
    }
}
