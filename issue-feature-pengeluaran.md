**Issue: Implementasi fitur Pengeluaran (tabel + API)**

**Ringkasan singkat**
- Tambah tabel `pengeluaran` dan API CRUD serta endpoint filter berdasarkan tahun/bulan/tanggal (opsional satu atau beberapa parameter).

**Spesifikasi data**
- Tabel: `pengeluaran`
  - `id` INTEGER AUTO INCREMENT (primary key)
  - `nama` VARCHAR(255) NOT NULL
  - `kategori_id` INTEGER (foreign key ke `kategori.id`)
  - `tgl` DATETIME
  - `created_at` TIMESTAMP DEFAULT current_timestamp

**API: ringkasan endpoint**
- Get semua pengeluaran
  - Method: GET
  - Endpoint: /api/pengeluaran
  - Response (200): { "data": [] }

- Get pengeluaran berdasarkan tahun/bulan/tanggal (opsional)
  - Method: GET
  - Endpoint: /api/pengeluaran/{tahun}/{tanggal}/{bulan}
  - Perilaku: parameter opsional; hanya tambahkan filter yang diberikan.
  - Response (200): { "data": [...] }

- Tambah pengeluaran
  - Method: POST
  - Endpoint: /api/pengeluaran
  - Request Body:
    {
      "nama": "Beli Makan Siang",
      "kategori_id": 3,
      "tgl": "2026-06-01"
    }
  - Response (201): { "data": "OK" }

- Hapus pengeluaran
  - Method: DELETE
  - Endpoint: /api/pengeluaran/{id}
  - Response Success (200): { "data": "OK" }
  - Response Error (404): { "error": "Pengeluaran Tidak Ada" }

- Edit pengeluaran
  - Method: PUT
  - Endpoint: /api/pengeluaran/{id}
  - Request Body: sama seperti create
  - Response Success (200): { "data": "OK" }

**Tahapan implementasi (high-level, untuk implementor junior/AI murah)**
1. Buat migration `create_pengeluaran_table`
   - Kolom sesuai spesifikasi. Tambahkan foreign key `kategori_id` jika tabel `kategori` ada.
2. Buat model Eloquent `Pengeluaran`
   - `protected $fillable = ['nama','kategori_id','tgl'];`
3. Buat controller `PengeluaranController` dengan method:
   - `index()` — ambil semua pengeluaran.
   - `filterByDate($tahun = null, $tanggal = null, $bulan = null)` — tambahkan whereYear/whereMonth/whereDay jika param ada.
   - `store(Request)` — validasi `nama`, `kategori_id` (exists), `tgl` (date), buat record.
   - `destroy($id)` — cari, jika tidak ada return 404; else hapus.
   - `update(Request,$id)` — validasi dan update.
4. Tambahkan routes di `routes/api.php`:
   - `Route::get('/pengeluaran', [PengeluaranController::class, 'index']);`
   - `Route::get('/pengeluaran/{tahun?}/{tanggal?}/{bulan?}', [PengeluaranController::class, 'filterByDate']);`
   - `Route::post('/pengeluaran', [PengeluaranController::class, 'store']);`
   - `Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy']);`
   - `Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update']);`
5. Tambah feature tests minimal:
   - Test index, filter variations, store success/validation, delete not found/success, update success.
6. Dokumentasi singkat di README: contoh request dan format tanggal.
7. Commit per langkah kecil dan buat PR untuk review.

**Contoh pseudo-code (filterByDate)**
- public function filterByDate($tahun = null, $tanggal = null, $bulan = null) {
    $query = Pengeluaran::query();
    if ($tahun) $query->whereYear('tgl', $tahun);
    if ($bulan) $query->whereMonth('tgl', $bulan);
    if ($tanggal) $query->whereDay('tgl', $tanggal);
    $items = $query->orderBy('tgl','desc')->get();
    return response(['data' => $items], 200);
  }

**Acceptance criteria**
- Migration dijalankan (`php artisan migrate`).
- Endpoint `GET /api/pengeluaran` dan filter mengembalikan 200 dengan struktur `{ "data": [...] }`.
- CRUD (create, update, delete) bekerja sesuai spesifikasi.
- Tests minimal lulus.

**Estimasi singkat**
- Junior developer: ~6–12 jam (termasuk tests & docs).

Catatan: ini planning high-level; jangan commit/push otomatis kecuali diarahkan.
