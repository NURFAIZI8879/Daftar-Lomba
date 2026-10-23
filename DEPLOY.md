# Deploy Daftar-Lomba (Kenten) ke Hosting Gratis (InfinityFree)

## 1. Buat akun & database
1. Daftar di https://infinityfree.com (gratis).
2. Buat website baru → catat:
   - Domain (mis. `kenten.infinityfreeapp.com`)
   - FTP username & password
   - MySQL database name (mis. `if0_XXXXXX_kenten`)
   - DB username (`if0_XXXXXX`)
   - DB password
   - DB host (mis. `sqlXXX.infinityfree.com`)
3. Buka **phpMyAdmin** → pilih database → tab **Import** → upload `database_infinityfree.sql` → Go.

## 2. Siapkan kredensial lokal (jangan commit)
1. Copy `config.local.php.example` → `config.local.php`.
2. Isi host/dbname/username/password sesuai langkah 1.
   - `config.local.php` sudah di-gitignore, aman.

## 3. Upload file
Upload **seluruh isi folder project** (termasuk `.htaccess`) ke folder `htdocs/` via File Manager / FTP.
Struktur di server:
```
htdocs/
├── .htaccess
├── config.php
├── config.local.php        (buat manual di server, jangan upload dari git)
├── bootstrap.php
├── routes.php
├── Core/
├── controllers/
├── views/
├── public/
│   ├── css/ js/ img/ favicon/
│   └── index.php
└── ...
```

## 4. Buat config.local.php di server
Di File Manager, buat file `htdocs/config.local.php` dengan kredensial DB (sama seperti langkah 2).

## 5. Akses
Buka `https://<domain-kamu>.infinityfreeapp.com/`

## Catatan
- PHP version InfinityFree saat ini 8.x — kode kompatibel.
- Jika 404 pada asset (css/js/img), pastikan `.htaccess` ter-upload dan mod_rewrite aktif (default aktif di InfinityFree).
- Jika error koneksi DB, cek host/dbname/user/pass di `config.local.php`.
- Jangan upload folder `Screenshots Kenten/` (besar) — boleh dihapus sebelum upload.
