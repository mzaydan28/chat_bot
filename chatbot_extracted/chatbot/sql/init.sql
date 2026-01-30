-- Init SQL for Chatbot SI Disperindag
CREATE DATABASE IF NOT EXISTS chatbot CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE chatbot;

CREATE TABLE IF NOT EXISTS users_admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  name VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB;

INSERT IGNORE INTO users_admin (username,password,name) VALUES
('admin','admin','Administrator');

CREATE TABLE IF NOT EXISTS kategori_layanan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

INSERT IGNORE INTO kategori_layanan (id,nama) VALUES (1,'UMKM'),(2,'Perdagangan'),(3,'Informasi Harga');

CREATE TABLE IF NOT EXISTS faq (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kategori_id INT DEFAULT NULL,
  pertanyaan TEXT NOT NULL,
  jawaban TEXT NOT NULL,
  dibuat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (kategori_id) REFERENCES kategori_layanan(id) ON DELETE SET NULL
) ENGINE=InnoDB;

INSERT IGNORE INTO faq (kategori_id,pertanyaan,jawaban) VALUES
(1,'Bagaimana cara mendaftar UMKM binaan?','Silakan kunjungi form pendataan UMKM di: https://disperindag.jateng.go.id/pendataan-umkm atau datang ke kantor Disperindag setempat.'),
(2,'Apa saja program Disperindag?','Program meliputi pembinaan UMKM, pengawasan pasar, fasilitasi perdagangan antar daerah, dan informasi harga pasar.'),
(3,'Kontak Disperindag Jawa Tengah','Telepon: (024) xxxx xxxx; Email: info@disperindag.jateng.go.id');

CREATE TABLE IF NOT EXISTS chat_session (
  id INT AUTO_INCREMENT PRIMARY KEY,
  session_key VARCHAR(100) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS chat_log (
  id INT AUTO_INCREMENT PRIMARY KEY,
  session_key VARCHAR(100) DEFAULT NULL,
  user_message TEXT,
  bot_response TEXT,
  kategori_id INT DEFAULT NULL,
  is_answered TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS chat_unanswered (
  id INT AUTO_INCREMENT PRIMARY KEY,
  session_key VARCHAR(100) DEFAULT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
