-- E-Belediye Veritabanı Tablosu Oluşturma

-- Vatandaşlar Tablosu
CREATE TABLE vatandaslar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad VARCHAR(50) NOT NULL,
    soyad VARCHAR(50) NOT NULL,
    tc_no VARCHAR(11) UNIQUE NOT NULL
);

-- Arsalar Tablosu
CREATE TABLE arsalar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    arsa_no VARCHAR(50) NOT NULL,
    adres VARCHAR(255) NOT NULL
);

-- İmar Planları Tablosu
CREATE TABLE imar_planlari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_adi VARCHAR(255) NOT NULL,
    tarih DATE NOT NULL
);

-- Bütçe Tablosu
CREATE TABLE butceler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    yili INT NOT NULL,
    toplam_budce DECIMAL(15, 2) NOT NULL,
    aciklama TEXT
);

-- Gelir Tablosu
CREATE TABLE gelirler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    butce_id INT,
    gelir_turu VARCHAR(255) NOT NULL,
    miktar DECIMAL(15, 2) NOT NULL,
    FOREIGN KEY (butce_id) REFERENCES butceler(id) ON DELETE CASCADE
);

-- Gider Tablosu
CREATE TABLE giderler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    butce_id INT,
    gider_turu VARCHAR(255) NOT NULL,
    miktar DECIMAL(15, 2) NOT NULL,
    FOREIGN KEY (butce_id) REFERENCES butceler(id) ON DELETE CASCADE
);

-- Katılım Talebi Tablosu
CREATE TABLE katilim_talepleri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vatandas_id INT,
    talep_turu VARCHAR(255) NOT NULL,
    aciklama TEXT,
    tarih DATE,
    FOREIGN KEY (vatandas_id) REFERENCES vatandaslar(id) ON DELETE CASCADE
);

-- Anket Tablosu
CREATE TABLE anketler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    soru TEXT NOT NULL,
    tarih DATE
);

-- Anket Yanıtları Tablosu
CREATE TABLE anket_yanitlari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    anket_id INT,
    vatandas_id INT,
    yanit TEXT NOT NULL,
    FOREIGN KEY (anket_id) REFERENCES anketler(id) ON DELETE CASCADE,
    FOREIGN KEY (vatandas_id) REFERENCES vatandaslar(id) ON DELETE CASCADE
);
