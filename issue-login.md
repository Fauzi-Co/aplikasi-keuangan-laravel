**Issue: API Login (Laravel Sanctum)**

Deskripsi singkat:
Buat fitur API login menggunakan Laravel Sanctum. Endpoint: `POST /api/login`.

Prasyarat:
- Project Laravel terpasang dan berjalan.
- PHP dan Composer tersedia.
- Jika belum terpasang, install Sanctum dan publish config:

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

edit :
pada model User, cukup tambahkan use HasApiTokens;

Spesifikasi API:
- Endpoint: `POST /api/login`
- Request body:

```json
{
  "email": "fauzico123@gmail.com",
  "password": "palingKau123_"
}
```
- Response sukses (200):

```json
{
  "token": "token"
}
```
- Response error validasi (422) atau kredensial salah (401):

```json
{
  "error": "Email dan Password Salah"
}
```

Tahapan implementasi (untuk junior programmer / AI murah):

1. Instalasi & konfigurasi Sanctum
   - Jalankan perintah di bagian prasyarat.
   - Pastikan middleware Sanctum terdaftar (lihat dokumentasi Laravel).

2. Tambah route API
   - Edit `routes/api.php` dan tambahkan:

```php
use App\Http\Controllers\AuthController;
Route::post('/login', [AuthController::class, 'login']);
```

3. Buat `AuthController`
   - Lokasi: `app/Http/Controllers/AuthController.php`.
   - Implementasi minimal (gunakan `validate()`, cek password, buat token):

```php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['error' => 'Email dan Password Salah'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }
}
```

4. Validasi input & response
   - Gunakan `validate()` untuk aturan input; Laravel mengembalikan 422 otomatis jika gagal.
   - Untuk kredensial salah, kembalikan response 401 dengan pesan seperti spesifikasi.

5. Proteksi endpoint lain
   - Gunakan middleware `auth:sanctum` untuk route yang memerlukan autentikasi.

6. Tambah tests (feature)
   - Buat `tests/Feature/LoginTest.php` yang memeriksa:
     - Login sukses mengembalikan `token` (status 200).
     - Kredensial salah mengembalikan 401 dengan pesan error.
     - Validasi input mengembalikan 422.

7. Keamanan dan catatan
   - Pastikan password tersimpan hashed (gunakan `bcrypt` atau `Hash::make`).
   - Pertimbangkan rate limiting untuk endpoint login.
   - Simpan token dengan aman di client.

Checklist pengerjaan:
- [ ] Instalasi & konfigurasi Sanctum
- [ ] Tambah route `POST /api/login`
- [ ] Implement `AuthController@login`
- [ ] Tambah tests dan jalankan
- [ ] Code review & PR

Jika mau, saya bisa juga membuat file controller dan contoh test secara otomatis di branch `feature/login`.
