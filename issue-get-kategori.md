**Issue: API Get Kategori (GET /api/kategori)**

**Ringkasan**
- Buat API endpoint untuk mengambil daftar `kategori`.

**Spesifikasi singkat**
- Endpoint: GET /api/kategori
- Response Success (200):
  {
    "data": [
      {
        "id": 1,
        "name": "nama kategori",
        "created_at": "2026-05-31T12:00:00Z"
      }
    ]
  }

**Tujuan**
- Berikan panduan high-level agar programmer junior atau model otomatis dapat mengimplementasikan endpoint ini dengan cepat dan aman.

**Tahapan implementasi (untuk junior programmer / AI murah)**
1. Tambah method `index` pada `KategoriController`.
   - Ambil semua record: `Kategori::orderBy('name')->get()` atau pilih field yang diperlukan.
   - Kembalikan response JSON dengan shape `{ "data": $items }`.
2. Tambah route di `routes/api.php`:
   - `Route::get('/kategori', [KategoriController::class, 'index']);`
3. Tambah feature test (minimal):
   - Buat beberapa kategori menggunakan factory atau `Kategori::create()`.
   - Panggil `GET /api/kategori` dan assert status `200`.
   - Assert struktur JSON: key `data` ada dan merupakan array; assert salah satu item memiliki `id` dan `name`.
4. Dokumentasikan di README contoh request dan respons (contoh `curl`).
5. Commit perubahan sebagai unit kecil: (routes + controller update), tests, docs.

**Contoh pseudo-code (controller)**
- public function index()
  {
    $items = Kategori::orderBy('name')->get(['id', 'name', 'created_at']);
    return response(['data' => $items], 200);
  }

**Contoh curl (untuk README)**
- curl -sS -X GET "http://localhost/api/kategori" -H "Accept: application/json"

**Acceptance criteria**
- Endpoint `GET /api/kategori` mengembalikan HTTP 200.
- Response JSON memiliki key `data` yang berisi array kategori.
- Feature test untuk endpoint lulus.

Catatan: sesuai permintaan, saya tidak akan melakukan commit atau push untuk file ini.
