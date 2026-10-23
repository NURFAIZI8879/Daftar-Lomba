-- Kenten Database Schema (reconstructed from source code)
-- Import this file into MySQL after creating database 'kenten'

CREATE DATABASE IF NOT EXISTS kenten CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kenten;

CREATE TABLE IF NOT EXISTS akun (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(255) NOT NULL,
    tipe VARCHAR(50) NOT NULL DEFAULT 'peserta'
);

CREATE TABLE IF NOT EXISTS lomba (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_berakhir DATE NOT NULL,
    deskripsi TEXT
);

CREATE TABLE IF NOT EXISTS tim (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_akun INT NOT NULL,
    nama VARCHAR(255) NOT NULL,
    nik VARCHAR(100),
    no_telp VARCHAR(50),
    kalangan VARCHAR(100),
    id_lomba INT NOT NULL,
    FOREIGN KEY (id_akun) REFERENCES akun(id) ON DELETE CASCADE,
    FOREIGN KEY (id_lomba) REFERENCES lomba(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS peserta_animasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tim INT NOT NULL,
    judul VARCHAR(255),
    storyboard TEXT,
    script TEXT,
    hasil_render TEXT,
    deskripsi TEXT,
    FOREIGN KEY (id_tim) REFERENCES tim(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS peserta_game (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tim INT NOT NULL,
    judul VARCHAR(255),
    gdd TEXT,
    file_eksekusi TEXT,
    trailer TEXT,
    kode_sumber TEXT,
    deskripsi TEXT,
    FOREIGN KEY (id_tim) REFERENCES tim(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS peserta_website (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tim INT NOT NULL,
    judul VARCHAR(255),
    wireframe TEXT,
    ui_ux TEXT,
    file_project TEXT,
    deskripsi TEXT,
    FOREIGN KEY (id_tim) REFERENCES tim(id) ON DELETE CASCADE
);

-- Seed admin account (password: admin@alauto.com)
INSERT INTO akun (email, password, nama, tipe) VALUES
('admin@alauto.com', '$2y$10$wfN6tc3mAbxvn575QR85oeodQ/LjqFKmVN52ng0UIupgnAWy.kvJS', 'Admin', 'admin');
