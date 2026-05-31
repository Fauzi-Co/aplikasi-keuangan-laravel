
**Issue: Implementasi fitur Kategori (tabel + API: tambah / hapus / edit)**

**Ringkasan singkat**
- Implementasi fitur CRUD kecil untuk `kategori` yang meliputi:
	- Tabel `kategori` di DB.
	- API untuk menambah (`POST /api/kategori`), menghapus (`DELETE /api/kategori/{id}`), dan mengedit (`PUT /api/kategori/{id}`).

**Spesifikasi data**
- Tabel: `kategori`
	- `id` INTEGER AUTO INCREMENT (primary key)
	- `name` VARCHAR(255) NOT NULL
	- `created_at` TIMESTAMP DEFAULT current_timestamp

**API: spesifikasi singkat**
- Tambah kategori
	- Method: POST
	- Endpoint: /api/kategori
	- Request Body:
		{
			"nama": "eko"
		}
	- Response Success (201): { "data": "OK" }
	- Response Error (409 duplicate): { "error": "kategori Sudah Ada" }

- Hapus kategori
	- Method: DELETE
	- Endpoint: /api/kategori/{id}
	- Response Success (200): { "data": "OK" }
	- Response Error (404 not found): { "error": "kategori Tidak Ada" }

- Edit kategori
	- Method: PUT
	- Endpoint: /api/kategori/{id}
	- Request Body:
		{
			"nama": "eko"
		}
	- Response Success (200): { "data": "OK" }
	- Response Error (404 not found): { "error": "kategori Tidak Ada" }
	- Response Error (409 duplicate name): { "error": "kategori Sudah Ada" }

**Tujuan implementasi**
- Berikan instruksi high-level agar programmer junior atau model otomatis dapat mengimplementasikan fitur ini end-to-end: migration, model, controller, routes, validasi, dan test sederhana.

**Tahapan implementasi (high-level, untuk implementor junior/AI murah)**
1. Buat migration `create_kategori_table`
	 - Kolom: `id`, `name` (string 255), `created_at` (useCurrent).
	 - Pastikan migration bermigrasi bersih.
2. Buat model Eloquent `Kategori`
	 - Tentukan `protected $fillable = ['name'];`
3. Buat controller `KategoriController` dengan method: `store`, `destroy`, `update`.
	 - `store`:
		 - Validasi input: `nama` required|string|max:255.
		 - Cek duplikasi (case-insensitive) sebelum insert.
		 - Jika duplikat: return 409 `{ "error": "kategori Sudah Ada" }`.
		 - Jika berhasil: create dan return 201 `{ "data": "OK" }`.
	 - `destroy`:
		 - Cari berdasarkan `id`.
		 - Jika tidak ditemukan: return 404 `{ "error": "kategori Tidak Ada" }`.
		 - Jika ditemukan: hapus dan return 200 `{ "data": "OK" }`.
	 - `update`:
		 - Validasi input: `nama` required|string|max:255.
		 - Cari `id`: jika tidak ada return 404.
		 - Jika ada, cek apakah `name` baru menyebabkan duplikasi pada record lain (case-insensitive).
		 - Jika duplikat: return 409.
		 - Update nama dan return 200 `{ "data": "OK" }`.
4. Tambahkan routes di `routes/api.php`:
	 - `Route::post('/kategori', [KategoriController::class, 'store']);`
	 - `Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);`
	 - `Route::put('/kategori/{id}', [KategoriController::class, 'update']);`
5. Tambah feature tests (PHPUnit/Laravel) — minimal test cases:
	 - Tambah kategori sukses (201).
	 - Tambah kategori duplikat (409).
	 - Hapus kategori sukses (200).
	 - Hapus kategori tidak ada (404).
	 - Edit kategori sukses (200).
	 - Edit jadi nama yang sudah ada (409).
6. Dokumentasi singkat di README:
	 - Cara menjalankan migration: `php artisan migrate`.
	 - Contoh `curl` untuk tiap endpoint.
7. Commit tiap langkah kecil (migration, model, controller, tests, docs) dan buat PR untuk review.

**Snippet contoh (pseudo-code) untuk implementor**
- Migration (concept):
	Schema::create('kategori', function (Blueprint $table) {
		$table->id();
		$table->string('name', 255);
		$table->timestamp('created_at')->useCurrent();
	});

- Controller `store` pseudo-flow:
	$request->validate(['nama' => 'required|string|max:255']);
	$name = trim($request->nama);
	if (Kategori::whereRaw('LOWER(name)=?', [strtolower($name)])->exists()) {
		return response(['error' => 'kategori Sudah Ada'], 409);
	}
	Kategori::create(['name' => $name]);
	return response(['data' => 'OK'], 201);

- Controller `destroy` pseudo-flow:
	$kategori = Kategori::find($id);
	if (! $kategori) return response(['error' => 'kategori Tidak Ada'], 404);
	$kategori->delete();
	return response(['data' => 'OK'], 200);

- Controller `update` pseudo-flow:
	$request->validate(['nama' => 'required|string|max:255']);
	$kategori = Kategori::find($id);
	if (! $kategori) return response(['error' => 'kategori Tidak Ada'], 404);
	$name = trim($request->nama);
	if (Kategori::whereRaw('LOWER(name)=?', [strtolower($name)])->where('id','<>',$id)->exists()) {
		return response(['error' => 'kategori Sudah Ada'], 409);
	}
	$kategori->update(['name' => $name]);
	return response(['data' => 'OK'], 200);

**Acceptance criteria**
- Migration dapat dijalankan dengan `php artisan migrate`.
- Endpoint berfungsi sesuai spesifikasi untuk success dan error cases.
- Tests minimal lulus.

**Estimasi singkat**
- Junior developer: ~3–6 jam (termasuk test dan dokumentasi singkat).

---
Rencana ini ditujukan agar mudah diimplementasikan oleh programmer junior atau model otomatis yang biaya rendah.
