# TiketIT - Sistem Helpdesk & Ticketing IT

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?logo=mysql&logoColor=white)](https://mysql.com/)
[![License](https://img.shields.io/badge/License-Educational-green)]()

Sistem Helpdesk & Ticketing IT untuk mengelola keluhan dan permintaan layanan IT di lingkungan organisasi. Pengguna (karyawan) dapat membuat tiket keluhan IT, dan tim IT (admin/teknisi) dapat mengelola, menugaskan, dan menyelesaikan tiket secara terstruktur.

> **Catatan:** Fondasi project ini berasal dari project tim "Kenten" (sistem pengelolaan kompetisi) yang dikembangkan lanjut dengan izin rekan tim. Semua nama, konsep, tampilan, dan teks telah diubah total menjadi sistem helpdesk.

---

## ✨ Fitur Utama

### Untuk Pengguna (Karyawan)
- 🎫 **Buat Tiket** — laporkan keluhan IT (kategori, judul, deskripsi, prioritas, lampiran screenshot)
- 📊 **Dashboard** — lihat status tiket (Open, In Progress, Waiting, Resolved, Closed)
- 💬 **Riwayat Penanganan** — timeline komentar dari teknisi dan pengguna
- 💻 **Aset Saya** — daftar perangkat/aset yang terdaftar
- 📚 **Knowledge Base** — FAQ dan solusi masalah umum (self-service)

### Untuk Admin / Teknisi
- 📋 **Kelola Tiket** — lihat semua tiket, filter, pencarian, assign teknisi
- 🔄 **Update Status** — Open → In Progress → Waiting → Resolved → Closed
- 👥 **Manajemen Kategori** — CRUD kategori layanan IT
- 📢 **Pengumuman** — buat pengumuman maintenance/gangguan/info
- 📚 **Knowledge Base** — CRUD artikel FAQ
- 💻 **Aset Perangkat** — lihat semua aset yang terdaftar
- 📊 **Dashboard Statistik** — jumlah tiket per status, per kategori

### Fitur Teknis
- 🔐 **Autentikasi** — login/register dengan password_hash (bcrypt)
- 👤 **Role-based access** — admin, teknisi, user
- ⚡ **SLA & Prioritas** — target waktu penyelesaian per prioritas (Critical: 4 jam, High: 24 jam, Medium: 48 jam, Low: 72 jam)
- 🔍 **Filter & Pencarian** — filter tiket by status, prioritas, kategori, search
- 📎 **Upload Lampiran** — screenshot/file (max 5MB, JPG/PNG/GIF/PDF)
- 🔒 **Keamanan** — prepared statements (PDO), validasi input, sanitasi output (XSS), session protection

---

## 🛠️ Tech Stack

| Teknologi | Fungsi |
|-----------|--------|
| **PHP 8.x** | Backend logic |
| **MySQL 8.x** | Database |
| **HTML/CSS/JS** | Frontend |
| **PDO** | Database access (prepared statements) |
| **Chart.js** | Dashboard chart (opsional) |

---

## 📁 Struktur Folder

```
TiketIT/
├── bootstrap.php          # DI bootstrap
├── config.php             # Konfigurasi database (env-based)
├── config.local.php       # Override kredensial (gitignored)
├── config.local.php.example # Template kredensial
├── routes.php             # Routing
├── database.sql           # Schema + seed data
├── database_infinityfree.sql  # Schema untuk InfinityFree
├── Core/                  # Framework mini
│   ├── App.php            # Application container
│   ├── Container.php      # DI container
│   ├── Database.php       # PDO wrapper
│   ├── Router.php         # Simple router
│   ├── Validator.php      # Input validation
│   ├── functions.php      # Helper functions
│   └── Response.php       # HTTP response
├── controllers/           # Logic per halaman
│   ├── index.php          # Landing page
│   ├── login/             # Login & check
│   ├── registration/      # Register
│   ├── logout.php         # Logout
│   ├── sandi.update.php   # Update password
│   ├── user/              # Dashboard user
│   │   ├── index.php
│   │   ├── tickets/       # CRUD tiket user
│   │   ├── assets/        # Aset user
│   │   └── knowledge/     # Knowledge base
│   └── admin/             # Dashboard admin
│       ├── index.php
│       ├── tickets/       # Kelola tiket
│       ├── categories/    # CRUD kategori
│       ├── assets/        # Lihat aset
│       ├── announcements/ # CRUD pengumuman
│       └── knowledge/     # CRUD knowledge base
├── views/                 # Tampilan (PHP templates)
│   ├── partials/          # head, foot
│   ├── dashboard_user/    # User views
│   └── dashboard_admin/   # Admin views
├── public/                # Static assets
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript
│   ├── img/               # Images
│   └── uploads/           # Uploaded files (gitignored)
├── .gitignore
└── README.md
```

---

## 🚀 Instalasi & Cara Menjalankan

### Prasyarat
- PHP 8.x
- MySQL 8.x
- Web server (Apache/Nginx) atau PHP built-in server

### Langkah-langkah

```bash
# 1. Clone repository
git clone https://github.com/NURFAIZI8879/Daftar-Lomba.git
cd Daftar-Lomba

# 2. Buat database
mysql -u root -p -e "CREATE DATABASE tiketit CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 3. Import schema
mysql -u root -p tiketit < database.sql

# 4. Konfigurasi database (opsional, default localhost/root/'')
# Buat file config.local.php jika perlu override:
# <?php return ['database' => ['host'=>'localhost','dbname'=>'tiketit','username'=>'root','password'=>'']];

# 5. Jalankan dengan PHP built-in server
php -S localhost:8000

# 6. Buka browser
# http://localhost:8000
```

### Deploy ke InfinityFree

1. Upload semua file ke `htdocs/`
2. Buat database di InfinityFree
3. Import `database_infinityfree.sql`
4. Buat `config.local.php` dengan kredensial InfinityFree
5. Akses via domain

---

## 👤 Akun Demo

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@tiketit.com` | `password` |
| Teknisi | `teknisi@tiketit.com` | `password` |
| User | `user@tiketit.com` | `password` |
| User 2 | `user2@tiketit.com` | `password` |

---

## 📐 Peran & Kontribusi

- **Peran:** Full-Stack Developer (solo)
- **Kontribusi:**
  - Rancang ulang database schema (8 tabel dengan relasi & foreign key).
  - Implementasi CRUD tiket (buat, lihat, update status, assign teknisi).
  - Implementasi komentar/riwayat penanganan per tiket.
  - Dashboard statistik (jumlah tiket per status, per kategori).
  - Filter & pencarian tiket.
  - Knowledge base / FAQ.
  - Pengumuman maintenance/gangguan.
  - Redesain tampilan (teal + white theme, responsive).
  - Refactor keamanan (prepared statements, password_hash, validasi input, sanitasi output, session protection, validasi upload).

---

## 🏆 Pencapaian

- Sistem helpdesk fungsional dengan 3 role (admin, teknisi, user).
- 8 tabel database dengan relasi dan foreign key yang benar.
- Seed data dummy untuk testing.
- Keamanan dasar terimplementasi (SQL injection prevention, XSS prevention, session protection, file upload validation).

---

## 🔮 Rencana Pengembangan

- [ ] Notifikasi real-time (WebSocket atau polling)
- [ ] Chart dashboard (Chart.js) untuk statistik
- [ ] Export laporan tiket (PDF/Excel)
- [ ] Rating kepuasan pengguna setelah tiket resolved
- [ ] Integrasi email notification
- [ ] API REST untuk mobile app
- [ ] Dark mode toggle

---

## 📞 Kontak

- **Nama:** Nurfaizi
- **Email:** faiziasyi140406@gmail.com
- **GitHub:** [https://github.com/NURFAIZI8879](https://github.com/NURFAIZI8879)
- **LinkedIn:** [ISI LINK LINKEDIN]
- **Lokasi:** Palembang, Sumatera Selatan

---

## 📄 Lisensi

Proyek ini untuk keperluan edukasi & portofolio.

---

> 💡 **Catatan untuk recruiter:** Project ini menunjukkan kemampuan rancang ulang sistem (database design, RBAC, CRUD, keamanan dasar), implementasi helpdesk ticketing, dan refactoring kode dari project lama ke konsep baru. Fondasi berasal dari project tim "Kenten" (sistem pengelolaan kompetisi) yang dikembangkan lanjut dengan izin rekan tim. Semua nama, konsep, tampilan, dan teks telah diubah total.