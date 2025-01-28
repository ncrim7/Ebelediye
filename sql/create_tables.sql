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

-- Eğer henüz boyut, latitude, longitude, fiyat, imar_durumu gibi sütunlar yoksa, aşağıdaki SQL ile tabloya bu sütunları ekleyebilirsiniz
ALTER TABLE arsalar
ADD boyut INT NOT NULL,
ADD fiyat DECIMAL(10,2) NOT NULL,
ADD imar_durumu VARCHAR(255) NOT NULL;
ADD latitude DECIMAL(10, 8),
ADD longitude DECIMAL(11, 8);

-- boyut, latitude, longitude, fiyat ve imar_durumu sütunlarını rastgele doldurmak için bir SQL sorgusu
UPDATE arsalar
SET 
    boyut = FLOOR(100 + (RAND() * 9900)), -- Rastgele boyut (100 ile 10,000 arasında)
    fiyat = FLOOR(10000 + (RAND() * 990000)), -- Rastgele fiyat (10,000 ile 1,000,000 ₺ arasında)
    imar_durumu = ELT(FLOOR(1 + (RAND() * 5)), 'Konut', 'Ticari', 'Sanayi', 'Tarım', 'Diğer'); -- Rastgele imar durumu
    latitude = ROUND(36 + (RAND() * (42 - 36)), 6), -- Türkiye enlemleri: 36 ile 42 arasında
    longitude = ROUND(26 + (RAND() * (45 - 26)), 6); -- Türkiye boylamları: 26 ile 45 arasında


-- İmar Planları Tablosu
CREATE TABLE imar_planlari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_adi VARCHAR(255) NOT NULL,
    tarih DATE NOT NULL
);

-- Eğer plan_turu sütunu mevcut değilse, aşağıdaki SQL sorgusuyla ekleyebilirsiniz
ALTER TABLE imar_planlari 
ADD plan_turu VARCHAR(50) NOT NULL;
ADD aciklama TEXT;
ADD dosya VARCHAR(255);

-- Eğer plan_turu sütunu boşsa, rastgele değerlerle doldurabilirsiniz
UPDATE imar_planlari
SET plan_turu = ELT(FLOOR(1 + (RAND() * 3)), 'imar', 'kentsel', 'çevre');
SET aciklama = 'Bu imar planına ait açıklama burada yer alır.' WHERE aciklama IS NULL OR aciklama = '';
SET dosya = 'plan1.pdf' WHERE id = 1; -- Örnek bir plan için dosya ekleme

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

-- Anket Cevapları Tablosu
CREATE TABLE anket_cevaplari (
    id INT AUTO_INCREMENT PRIMARY KEY,
    anket_id INT NOT NULL,
    cevap TEXT NOT NULL,
    FOREIGN KEY (anket_id) REFERENCES anketler(id) ON DELETE CASCADE
);

