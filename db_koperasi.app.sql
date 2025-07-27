-- 1. Buat database
CREATE DATABASE IF NOT EXISTS koperasi_ujikom;
USE koperasi_ujikom;

-- 2. Tabel level
DROP TABLE IF EXISTS level;
CREATE TABLE level (
  id_level INT AUTO_INCREMENT PRIMARY KEY,
  nama_level VARCHAR(50) NOT NULL
);

-- 3. Tabel petugas
DROP TABLE IF EXISTS petugas;
CREATE TABLE petugas (
  id_petugas INT AUTO_INCREMENT PRIMARY KEY,
  nama_petugas VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  id_level INT,
  FOREIGN KEY (id_level) REFERENCES level(id_level) ON DELETE SET NULL
);

-- 4. Tabel customer
DROP TABLE IF EXISTS customer;
CREATE TABLE customer (
  id_customer INT AUTO_INCREMENT PRIMARY KEY,
  nama_customer VARCHAR(100),
  alamat TEXT,
  telp VARCHAR(20),
  fax VARCHAR(20),
  email VARCHAR(100)
);

-- 5. Tabel sales
DROP TABLE IF EXISTS sales;
CREATE TABLE sales (
  id_sales INT AUTO_INCREMENT PRIMARY KEY,
  tgl_sales DATE NOT NULL,
  id_customer INT NOT NULL,
  do_customer VARCHAR(50),
  status ENUM('Lunas','Belum Lunas') DEFAULT 'Belum Lunas',
  FOREIGN KEY (id_customer) REFERENCES customer(id_customer) ON DELETE CASCADE
);

-- 6. Tabel item
DROP TABLE IF EXISTS item;
CREATE TABLE item (
  id_item INT AUTO_INCREMENT PRIMARY KEY,
  nama_item VARCHAR(100),
  satuan VARCHAR(50),
  harga_beli DECIMAL(12,2),
  harga_jual DECIMAL(12,2),
  stok INT DEFAULT 0
);

-- 7. Tabel transaksi
DROP TABLE IF EXISTS transaksi;
CREATE TABLE transaksi (
  id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
  id_sales INT,
  id_item INT,
  jumlah INT,
  price DECIMAL(12,2),
  amount DECIMAL(12,2),
  FOREIGN KEY (id_sales) REFERENCES sales(id_sales),
  FOREIGN KEY (id_item) REFERENCES item(id_item)
);

-- 8. Tabel transaksi sementara
DROP TABLE IF EXISTS transaksi_temp;
CREATE TABLE transaksi_temp (
  id_transaksi_temp INT AUTO_INCREMENT PRIMARY KEY,
  id_sales INT,
  id_item INT,
  jumlah INT,
  price DECIMAL(12,2),
  amount DECIMAL(12,2),
  session_id VARCHAR(100),
  remark TEXT,
  FOREIGN KEY (id_sales) REFERENCES sales(id_sales),
  FOREIGN KEY (id_item) REFERENCES item(id_item)
);

-- 9. Tabel identitas koperasi
DROP TABLE IF EXISTS identitas;
CREATE TABLE identitas (
  id_identitas INT AUTO_INCREMENT PRIMARY KEY,
  nama_identitas VARCHAR(100),
  badan_hukum VARCHAR(250),
  npwp VARCHAR(20),
  fax VARCHAR(20),
  alamat TEXT,
  telp VARCHAR(20),
  email VARCHAR(100),
  rekening VARCHAR(50),
  foto VARCHAR(255)
);

-- 10. Data awal level
INSERT INTO level (id_level, nama_level) VALUES 
(1, 'admin'),
(2, 'petugas');

-- 11. Admin default (username: admin, password: admin)
DELETE FROM petugas;
INSERT INTO petugas (nama_petugas, username, password, id_level) VALUES (
  'Admin Koperasi',
  'admin',
  '$2y$10$uVWfgDqiOYb8wE9E9Wyw2OPHgYxWyoZNZmAAvXUMSt.6gSWRmR5Me', -- hash dari 'admin'
  1
);
