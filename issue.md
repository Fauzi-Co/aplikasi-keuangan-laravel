**Issue: Ubah konfigurasi environment database ke MySQL**

**Ringkasan singkat**
- Ubah konfigurasi environment aplikasi agar menggunakan MySQL dengan pengaturan berikut:
  - Host: `127.0.0.1` (default) atau sesuai environment
  - Port: `3307`
  - Database: `aplikasi_keuangan_laravel`
  - Username: `root`
  - Password: (kosong / tidak ada)

**Tujuan**
- Pastikan aplikasi terhubung ke MySQL dengan pengaturan di atas; dokumentasikan langkah yang diperlukan agar implementor (junior developer atau model otomatis) dapat melakukan perubahan dengan aman.

**Ruang lingkup**
- Hanya ubah/siapkan konfigurasi environment (`.env`).
- Jangan mengubah kode lain, migration, atau melakukan commit/push otomatis.

**Tahapan implementasi (high-level)**
1. Perbarui file `.env` (atau buat petunjuk) dengan variabel database:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3307`
   - `DB_DATABASE=aplikasi_keuangan_laravel`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=`
2. Instruksikan developer untuk menyalin `.env` ke `.env` (lokal) dan mengisi sesuai kebutuhan.
3. Verifikasi koneksi database:
   - Gunakan `php artisan migrate:status` atau koneksi sederhana untuk memastikan aplikasi dapat terhubung.
4. Jika MySQL tidak berjalan di port `3307` pada mesin developer, beri opsi alternatif (contoh: jalankan container Docker dengan mapping port `3307:3306`).
5. Jangan melakukan perubahan lain atau commit/push dari tugas ini — biarkan developer yang mengeksekusi langkah selanjutnya.

**Contoh singkat instruksi untuk README atau PR**
- Tambahkan catatan singkat:
  - "Untuk development, gunakan MySQL pada port 3307. Salin `.env` ke `.env` dan pastikan variabel DB sudah sesuai. Jika tidak ada password untuk `root`, biarkan `DB_PASSWORD` kosong."

**Acceptance criteria**
- `.env` diperbarui (lokal) atau petunjuk jelas tersedia.
- Developer dapat menjalankan `php artisan migrate:status` tanpa error koneksi (setelah mereka mengisi `.env` dan memastikan MySQL aktif).

Catatan: file ini hanya perencanaan. Saya tidak akan melakukan commit atau push setelah menambahkan file ini.
