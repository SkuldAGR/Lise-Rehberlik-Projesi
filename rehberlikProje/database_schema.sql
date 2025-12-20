CREATE DATABASE IF NOT EXISTS ogrenci;
USE ogrenci;

-- Girdiler Tablosu
CREATE TABLE IF NOT EXISTS girdiler (
    id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Benzersiz kayıt numarası',
    tarih DATE NOT NULL COMMENT 'Görüşme tarihi',
    saat TIME NOT NULL COMMENT 'Görüşme saati',
    ogrenci_adi VARCHAR(100) NOT NULL COMMENT 'Öğrencinin adı soyadı',
    sinif VARCHAR(20) NOT NULL COMMENT 'Öğrencinin sınıfı',
    veli_adi VARCHAR(100) DEFAULT NULL COMMENT 'Veli adı soyadı',
    gorusme_turu VARCHAR(50) DEFAULT NULL COMMENT 'Görüşme türü (Bireysel, Grup, Veli vb.)',
    konu TEXT DEFAULT NULL COMMENT 'Görüşme konusu detayları',
    asama VARCHAR(50) DEFAULT NULL COMMENT 'İşlem aşaması (Başvuru, Devam Ediyor, Tamamlandı vb.)',
    notlar TEXT DEFAULT NULL COMMENT 'Ek notlar ve gözlemler',
    olusturma_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Kaydın oluşturulma zamanı',
    guncellenme_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Kaydın son güncellenme zamanı',
    INDEX idx_tarih (tarih),
    INDEX idx_ogrenci (ogrenci_adi),
    INDEX idx_sinif (sinif),
    INDEX idx_asama (asama)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Öğrenci görüşme kayıtları';

-- Örnek Veri Ekleme (Opsiyonel)
-- Bu bölümü geliştirme ortamında test için kullanabilirsiniz

INSERT INTO girdiler (tarih, saat, ogrenci_adi, sinif, veli_adi, gorusme_turu, konu, asama, notlar) VALUES
    ('2025-01-15', '09:00:00', 'Ahmet Yılmaz', '9-A', 'Mehmet Yılmaz', 'Bireysel', 'Ders başarısı', 'Devam Ediyor', 'Öğrenci matematik dersinde zorluk yaşıyor'),
    ('2025-01-16', '10:30:00', 'Ayşe Demir', '10-B', 'Fatma Demir', 'Veli Görüşmesi', 'Davranış problemi', 'Başvuru', 'Veli ile görüşme planlandı'),
    ('2025-01-17', '14:00:00', 'Mehmet Kaya', '11-C', NULL, 'Bireysel', 'Kariyer danışmanlığı', 'Tamamlandı', 'Üniversite tercihleri konuşuldu'),
    ('2025-01-18', '11:00:00', 'Zeynep Şahin', '9-A', 'Ali Şahin', 'Grup', 'Sosyal beceriler', 'Devam Ediyor', 'Grup çalışması 4 hafta sürecek')
ON DUPLICATE KEY UPDATE id=id;

-- Kullanıcı Tablosu (Opsiyonel - Giriş sistemi için)
CREATE TABLE IF NOT EXISTS kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_adi VARCHAR(50) UNIQUE NOT NULL,
    sifre VARCHAR(255) NOT NULL COMMENT 'Hashlenmiş şifre',
    ad_soyad VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    rol VARCHAR(20) DEFAULT 'rehber' COMMENT 'admin, rehber, gozetmen vb.',
    aktif BOOLEAN DEFAULT TRUE,
    son_giris TIMESTAMP NULL,
    olusturma_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Sistem kullanıcıları';

-- Varsayılan admin kullanıcısı (şifre: admin123)
-- UYARI: Gerçek kullanımda mutlaka değiştirin!
INSERT INTO kullanicilar (kullanici_adi, sifre, ad_soyad, email, rol) VALUES
    ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin User', 'admin@example.com', 'admin')
ON DUPLICATE KEY UPDATE id=id;

-- İstatistikler için View
CREATE OR REPLACE VIEW gorusme_istatistikleri AS
SELECT 
    DATE_FORMAT(tarih, '%Y-%m') as ay,
    COUNT(*) as toplam_gorusme,
    COUNT(DISTINCT ogrenci_adi) as benzersiz_ogrenci,
    COUNT(DISTINCT sinif) as farkli_sinif,
    gorusme_turu,
    asama
FROM girdiler
GROUP BY ay, gorusme_turu, asama;

-- Backup için procedure (Opsiyonel)
DELIMITER //

CREATE PROCEDURE backup_girdiler()
BEGIN
    CREATE TABLE IF NOT EXISTS girdiler_backup LIKE girdiler;
    INSERT INTO girdiler_backup SELECT * FROM girdiler;
END //

DELIMITER ;

-- Kullanım izinleri
-- GRANT ALL PRIVILEGES ON ogrenci.* TO 'rehberlik_user'@'localhost' IDENTIFIED BY 'guvenli_sifre';
-- FLUSH PRIVILEGES;
