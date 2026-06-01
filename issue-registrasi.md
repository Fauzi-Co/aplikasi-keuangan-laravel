**Issue: Implementasi API Registrasi Users**

Ringkasan singkat
- Tambah endpoint API untuk registrasi user.
- Endpoint (sesuai permintaan): `POST /api/registrasi`

Spesifikasi
- Endpoint: `POST /api/registrasi`
- Request Body (JSON):

```
{
  "name": "Andi Lau",
  "email": "andi@gmail.com",
  "password": "palingKau123_"
}
```

- Response Success (200):

```
{ "data": [] }
```

- Response Error (contoh - email duplikat):

```
{ "error": "Email Sudah Terpakai" }
```

Tahapan implementasi (untuk junior programmer / AI murah)
1. Periksa apakah tabel `users` sudah ada.
   - Jika belum ada, buat migration `create_users_table` dengan kolom `id`, `name`, `email` (unique), `password`, `created_at`.
2. Buat atau gunakan model Eloquent `User`.
   - Pastikan `protected $fillable = ['name','email','password'];` dan `public $timestamps = true`.
3. Tambah route API di `routes/api.php`:
   - `Route::get('/registrasi', [Auth\RegistrationController::class, 'register']);`
   - (Catatan: secara praktik gunakan `post`, namun ikuti spesifikasi jika diminta.)
4. Buat controller `Auth\RegistrationController` dengan method `register(Request $request)`:
   - Validasi input:
     - `name` => `required|string|max:255`
     - `email` => `required|email|unique:users,email`
     - `password` => `required|string|min:8`
   - Jika validasi gagal, return 422 dengan pesan error.
   - Cek apakah email sudah terpakai (unique rule menangani ini). Jika terpakai, return 400/409 dengan `{ "error": "Email Sudah Terpakai" }`.
   - Hash password (`Hash::make($request->password)`), lalu simpan user.
   - Return response `{ "data": [] }` dengan status 200 (atau 201 jika ingin mengikuti RESTful create).
5. Tambahkan unit/feature tests minimal di `tests/Feature/RegistrasiTest.php`:
   - Test registrasi sukses.
   - Test registrasi gagal karena email sudah terpakai.
   - Test registrasi gagal karena password kurang dari 8 karakter.
6. Dokumentasi singkat di README atau `docs/`:
   - Contoh request dan response.
7. Commit perubahan per langkah kecil dan buka PR untuk code review.

Contoh pseudo-code (controller)
```
public function register(Request $r) {
  $v = Validator::make($r->all(), [
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|string|min:8',
  ]);
  if ($v->fails()) return response(['error' => $v->errors()->first()], 422);

  $user = User::create([
    'name' => $r->name,
    'email' => $r->email,
    'password' => Hash::make($r->password),
  ]);

  return response(['data' => []], 200);
}
```

Acceptance criteria
- Terdapat route `GET /api/registrasi` yang menerima JSON sesuai spesifikasi.
- Validasi email unik menghasilkan `{ "error": "Email Sudah Terpakai" }`.
- Registrasi sukses mengembalikan `{ "data": [] }`.
- Tests untuk success & duplicate-email dibuat dan lulus.

Estimasi
- Junior dev (implementasi + tests + docs): 2–6 jam.

Catatan tambahan
- Sangat direkomendasikan mengganti method ke `POST` untuk keamanan dan kesesuaian praktik REST.
- Gunakan `Hash::make` untuk password dan jangan menyimpan password mentah di log atau responses.
