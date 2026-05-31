**Issue: Inisialisasi Project Laravel dengan MySQL**

**Ringkasan**
- Buat project Laravel baru di folder repo ini, menggunakan MySQL sebagai database.

**Tujuan**
- Sediakan skeleton aplikasi siap dikembangkan: konfigurasi environment, koneksi database, struktur model dasar, autentikasi, dan dokumentasi singkat.

**Ruang Lingkup**
- Inisialisasi project Laravel dan konfigurasi MySQL.
- Implementasi struktur dasar (models, migrations) untuk fitur keuangan inti.
- Autentikasi dasar dan manajemen pengguna.
- Dokumentasi pengaturan dan langkah menjalankan aplikasi.

**Asumsi & Dependensi**
- Pengembang memiliki akses ke MySQL (local atau container).
- Menggunakan versi Laravel LTS yang direkomendasikan oleh tim.
- Composer dan PHP sudah tersedia pada environment developer/CI.

**Deliverables**
- Project Laravel ter-inisialisasi di folder ini.
- File `.env.example` terkonfigurasi untuk MySQL.
- Migrations dasar untuk entitas inti.
- Instruksi singkat di README untuk menjalankan lokal.

**Milestone & Tugas (high-level)**
- **1. Inisialisasi**: Buat skeleton Laravel (`composer create-project` atau instalasi setara), commit awal.
- **2. Konfigurasi DB**: Tambah konfigurasi MySQL di `.env.example` dan cek koneksi dasar.
- **3. Models & Migrations**: Tambah models dan migrations untuk entitas inti (mis. User, Account, Transaction).
- **4. Autentikasi**: Tambah sistem autentikasi dasar (login, register, reset password) sesuai standar Laravel.
- **5. Fitur Inti**: Implementasi endpoint dan logika dasar untuk mencatat transaksi dan saldo.
- **6. Testing & CI**: Tambah beberapa test integrasi dasar dan siapkan pipeline CI sederhana.
- **7. Dokumentasi**: Tulis README singkat yang menjelaskan setup, migration, dan cara menjalankan lokal.
- **8. Deployment**: Siapkan konfigurasi dasar untuk environment produksi (env vars, DB migration pada deploy).

**Kriteria Penerimaan**
- Aplikasi dapat di-install secara lokal mengikuti README.
- Migrasi berjalan tanpa error dan aplikasi terhubung ke MySQL.
- Endpoint autentikasi dan minimal CRUD untuk fitur keuangan berfungsi.

**Risiko & Mitigasi**
- Jika versi PHP/Composer tidak kompatibel, dokumentasikan versi minimal dan saran upgrade.
- Jika akses MySQL terbatas, rekomendasikan penggunaan Docker Compose untuk development.

**Estimasi & Catatan**
- Estimasi kasar: 1–3 hari kerja untuk scaffold dan fitur dasar (bergantung ukuran tim).
- Jaga scope kecil: fokus pada skeleton dan fitur minimal, biarkan iterasi fitur lanjutan untuk issue terpisah.

---
Rencana ini ditulis sebagai panduan high-level untuk programmer atau model otomatis yang akan mengimplementasikan detail teknis.
