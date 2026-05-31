**Issue: Inisialisasi Project Laravel dengan MySQL**

**Ringkasan**
- Buat project Laravel baru di folder ini, menggunakan MySQL sebagai database.

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
- **1. Inisialisasi**: Buat skeleton Laravel, commit awal.
- **2. Konfigurasi DB**: Tambah konfigurasi MySQL di `.env.example` dan verifikasi koneksi.
- **3. Models & Migrations**: Tambah models/migrations inti (User, Account, Transaction).
- **4. Autentikasi**: Tambah autentikasi standar (register/login/reset).
- **5. Fitur Inti**: Implementasi logika dasar untuk mencatat transaksi dan menghitung saldo.
- **6. Testing & CI**: Tambah beberapa test integrasi dan pipeline CI dasar.
- **7. Dokumentasi**: Tulis README singkat yang menjelaskan setup dan cara menjalankan lokal.
- **8. Deployment**: Siapkan langkah migrasi DB dan env di lingkungan produksi.

**Kriteria Penerimaan**
- Aplikasi dapat di-install secara lokal mengikuti README.
- Migrasi berjalan tanpa error dan aplikasi terhubung ke MySQL.
- Endpoint autentikasi dan CRUD dasar untuk fitur keuangan berfungsi.

**Risiko & Mitigasi**
- Versi PHP/Composer tidak cocok: dokumentasikan versi minimal.
- Akses MySQL terbatas: rekomendasikan Docker Compose untuk development.

**Estimasi & Catatan**
- Estimasi kasar: 1–3 hari kerja untuk scaffold dan fitur dasar.
- Scope dijaga kecil: fokus pada skeleton dan fitur minimal, iterasi lanjutan terpisah.

---
Rencana high-level ini ditujukan untuk programmer atau model otomatis yang akan mengimplementasikan detail teknis.
