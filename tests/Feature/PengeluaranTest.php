<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Pengeluaran;

class PengeluaranTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_list()
    {
        Pengeluaran::create(['nama' => 'a', 'kategori_id' => null, 'tgl' => '2026-06-01']);
        Pengeluaran::create(['nama' => 'b', 'kategori_id' => null, 'tgl' => '2026-06-02']);
        $res = $this->getJson('/api/pengeluaran');
        $res->assertStatus(200)->assertJsonStructure(['data' => [['id','nama','kategori_id','tgl','created_at']]]);
    }

    public function test_filter_by_date()
    {
        Pengeluaran::create(['nama' => 'x', 'kategori_id' => null, 'tgl' => '2025-06-01']);
        Pengeluaran::create(['nama' => 'y', 'kategori_id' => null, 'tgl' => '2026-06-01']);
        $res = $this->getJson('/api/pengeluaran/2026');
        $res->assertStatus(200);
        $this->assertCount(1, $res->json('data'));
    }

    public function test_store_and_delete()
    {
        $res = $this->postJson('/api/pengeluaran', ['nama' => 'Lunch', 'kategori_id' => null, 'tgl' => '2026-06-01']);
        $res->assertStatus(201)->assertJson(['data' => 'OK']);
        $id = Pengeluaran::first()->id;
        $res2 = $this->deleteJson('/api/pengeluaran/' . $id);
        $res2->assertStatus(200)->assertJson(['data' => 'OK']);
    }

    public function test_update_not_found()
    {
        $res = $this->putJson('/api/pengeluaran/999', ['nama' => 'x', 'kategori_id' => null, 'tgl' => '2026-06-01']);
        $res->assertStatus(404)->assertJson(['error' => 'Pengeluaran Tidak Ada']);
    }
}
