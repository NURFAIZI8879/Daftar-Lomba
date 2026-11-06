/* TiketIT Database Schema (for InfinityFree - no CREATE DATABASE)
-- Import into your existing database (if0_XXXXXXX_XXX) */

-- ============================================================
-- Tabel: users (Pengguna sistem)
-- ============================================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(255) NOT NULL,
    role ENUM('admin', 'teknisi', 'user') NOT NULL DEFAULT 'user',
    departemen VARCHAR(100),
    no_telp VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- Tabel: categories (Kategori layanan IT)
-- ============================================================
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    icon VARCHAR(50) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- Tabel: assets (Data perangkat/aset pengguna)
-- ============================================================
CREATE TABLE IF NOT EXISTS assets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    nama_perangkat VARCHAR(255) NOT NULL,
    spesifikasi TEXT,
    lokasi VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================================
-- Tabel: tickets (Tiket keluhan IT)
-- ============================================================
CREATE TABLE IF NOT EXISTS tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_category INT NOT NULL,
    id_teknisi INT DEFAULT NULL,
    id_asset INT DEFAULT NULL,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    prioritas ENUM('low', 'medium', 'high', 'critical') NOT NULL DEFAULT 'medium',
    status ENUM('open', 'in_progress', 'waiting', 'resolved', 'closed') NOT NULL DEFAULT 'open',
    lampiran VARCHAR(255) DEFAULT NULL,
    sla_jam INT NOT NULL DEFAULT 48,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    resolved_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id_category) REFERENCES categories(id) ON DELETE RESTRICT,
    FOREIGN KEY (id_teknisi) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (id_asset) REFERENCES assets(id) ON DELETE SET NULL
);

-- ============================================================
-- Tabel: ticket_comments (Komentar/riwayat penanganan)
-- ============================================================
CREATE TABLE IF NOT EXISTS ticket_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ticket INT NOT NULL,
    id_user INT NOT NULL,
    komentar TEXT NOT NULL,
    lampiran VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_ticket) REFERENCES tickets(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================================
-- Tabel: announcements (Pengumuman maintenance/gangguan)
-- ============================================================
CREATE TABLE IF NOT EXISTS announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    tipe ENUM('maintenance', 'gangguan', 'info') NOT NULL DEFAULT 'info',
    id_author INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expired_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (id_author) REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================================
-- Tabel: knowledge_base (FAQ / solusi masalah umum)
-- ============================================================
CREATE TABLE IF NOT EXISTS knowledge_base (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_category INT DEFAULT NULL,
    judul VARCHAR(255) NOT NULL,
    masalah TEXT NOT NULL,
    solusi TEXT NOT NULL,
    tags VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_category) REFERENCES categories(id) ON DELETE SET NULL
);

-- ============================================================
-- SEED DATA: Kategori Layanan IT
-- ============================================================
INSERT INTO categories (nama, deskripsi, icon) VALUES
('Hardware', 'Masalah perangkat keras: laptop, PC, printer, monitor, dll.', '[HW]'),
('Jaringan', 'Masalah jaringan: WiFi, LAN, VPN, internet, dll.', '[NET]'),
('Software', 'Masalah aplikasi/software: instalasi, error, update, dll.', '[SW]'),
('Akun & Email', 'Masalah akun: password, email, akses sistem, dll.', '[ACC]'),
('Lainnya', 'Masalah IT lainnya yang tidak termasuk kategori di atas.', '[OTH]');

-- ============================================================
-- SEED DATA: Akun Demo
-- Password: admin123 (hash bcrypt)
-- ============================================================
INSERT INTO users (email, password, nama, role, departemen, no_telp) VALUES
('admin@tiketit.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin TiketIT', 'admin', 'IT', '081234567890'),
('teknisi@tiketit.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Teknisi Satu', 'teknisi', 'IT', '081234567891'),
('user@tiketit.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', 'user', 'Keuangan', '081234567892'),
('user2@tiketit.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Siti Rahayu', 'user', 'HRD', '081234567893');

-- ============================================================
-- SEED DATA: Aset Perangkat (dummy)
-- ============================================================
INSERT INTO assets (id_user, nama_perangkat, spesifikasi, lokasi) VALUES
(3, 'Laptop Dell Inspiron 15', 'Intel Core i5, RAM 8GB, SSD 256GB', 'Ruang Keuangan'),
(3, 'Printer HP LaserJet Pro', 'HP LaserJet Pro M404dn', 'Ruang Keuangan'),
(4, 'PC Desktop Lenovo', 'Intel Core i3, RAM 4GB, HDD 500GB', 'Ruang HRD'),
(4, 'Monitor LG 24"', 'LG 24MP88HV-S', 'Ruang HRD');

-- ============================================================
-- SEED DATA: Tiket (dummy)
-- ============================================================
INSERT INTO tickets (id_user, id_category, id_teknisi, id_asset, judul, deskripsi, prioritas, status, sla_jam, created_at) VALUES
(3, 1, 2, 1, 'Laptop lambat saat booting', 'Laptop Dell Inspiron 15 sering lambat saat booting, waktu booting bisa 5-10 menit. Sudah coba restart tapi tidak ada perubahan.', 'high', 'in_progress', 24, '2026-11-01 08:00:00'),
(3, 2, NULL, NULL, 'WiFi tidak bisa connect', 'Tidak bisa connect ke WiFi kantor sejak pagi. SSID muncul tapi gagal autentikasi.', 'medium', 'open', 48, '2026-11-02 09:30:00'),
(4, 3, 2, 3, 'Aplikasi Excel error', 'Microsoft Excel sering crash saat membuka file besar (>50MB). Sudah update tapi masih error.', 'low', 'waiting', 72, '2026-11-01 14:00:00'),
(4, 4, NULL, NULL, 'Lupa password email kantor', 'Lupa password email kantor, butuh reset password.', 'critical', 'open', 4, '2026-11-03 07:45:00'),
(3, 1, 2, 2, 'Printer tidak bisa print', 'Printer HP LaserJet tidak bisa print, lampu merah berkedip. Sudah ganti toner tapi tetap error.', 'medium', 'resolved', 48, '2026-10-28 10:00:00');

UPDATE tickets SET resolved_at = '2026-10-29 11:30:00' WHERE id = 5;

-- ============================================================
-- SEED DATA: Komentar Tiket (dummy)
-- ============================================================
INSERT INTO ticket_comments (id_ticket, id_user, komentar, created_at) VALUES
(1, 2, 'Sudah cek laptop, RAM penuh (95%). Akan dilakukan pembersihan startup dan cek malware.', '2026-11-01 09:00:00'),
(1, 3, 'Terima kasih, ditunggu penyelesaiannya.', '2026-11-01 09:15:00'),
(5, 2, 'Printer sudah diperbaiki, masalah pada roller paper yang aus. Sudah diganti.', '2026-10-29 10:00:00'),
(5, 3, 'Baik, sudah bisa print normal. Terima kasih!', '2026-10-29 11:00:00');

-- ============================================================
-- SEED DATA: Pengumuman (dummy)
-- ============================================================
INSERT INTO announcements (judul, isi, tipe, id_author, created_at, expired_at) VALUES
('Maintenance Server', 'Server akan mengalami maintenance pada hari Sabtu, 8 November 2026 pukul 22:00-02:00 WIB. Layanan mungkin terganggu selama maintenance.', 'maintenance', 1, '2026-11-03 08:00:00', '2026-11-09 02:00:00'),
('Gangguan Jaringan', 'Saat ini terjadi gangguan pada jaringan WiFi lantai 2. Tim IT sedang menangani. Estimasi selesai 2 jam.', 'gangguan', 1, '2026-11-04 10:00:00', '2026-11-04 14:00:00'),
('Info Sistem Baru', 'Sistem tiket helpdesk baru telah aktif. Silakan gunakan untuk melaporkan keluhan IT.', 'info', 1, '2026-11-01 08:00:00', NULL);

-- ============================================================
-- SEED DATA: Knowledge Base / FAQ (dummy)
-- ============================================================
INSERT INTO knowledge_base (id_category, judul, masalah, solusi, tags) VALUES
(1, 'Laptop Lambat', 'Laptop sering lambat saat booting atau membuka aplikasi.', '1. Tutup aplikasi yang tidak digunakan.\n2. Hapus file temporary (Disk Cleanup).\n3. Disable startup programs yang tidak perlu.\n4. Scan malware.\n5. Jika masih lambat, pertimbangkan upgrade RAM atau SSD.', 'laptop,lambat,booting,slow'),
(2, 'Tidak Bisa Connect WiFi', 'Tidak bisa connect ke WiFi kantor.', '1. Pastikan WiFi turned on.\n2. Lupa jaringan dan connect ulang.\n3. Restart router/access point.\n4. Update driver WiFi adapter.\n5. Hubungi IT jika masih gagal.', 'wifi,jaringan,connect,internet'),
(3, 'Excel Crash', 'Microsoft Excel crash saat membuka file besar.', '1. Update Microsoft Office ke versi terbaru.\n2. Disable add-ins yang tidak perlu.\n3. Repair Office via Control Panel.\n4. Buka file dalam Safe Mode.\n5. Jika file corrupt, gunakan Open and Repair.', 'excel,crash,office,microsoft'),
(4, 'Lupa Password Email', 'Lupa password email kantor.', '1. Hubungi admin IT.\n2. Verifikasi identitas (NIK/nama).\n3. Admin akan reset password.\n4. Login dengan password baru dan segera ganti.', 'password,email,reset,akun');
