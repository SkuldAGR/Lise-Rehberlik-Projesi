# 📚 Rehberlik Öğrenci Takip Sistemi - Güvenlik Notları

## 🔒 Güvenlik Önlemleri

### Önemli Güvenlik Uyarıları

1. **Veritabanı Bağlantıları**
   - `php/ayar.php` dosyası GitHub'a asla yüklenMEMELİDİR (`.gitignore` ile korunur)
   - Gerçek veritabanı bilgilerinizi sadece yerel ortamınızda kullanın
   - Üretim ortamında güçlü şifreler kullanın

2. **SQL Injection Koruması**
   - Tüm kullanıcı girdileri için prepared statements kullanın
   - Direkt string concatenation ile SQL sorguları YAPMAIN

3. **XSS (Cross-Site Scripting) Koruması**
   - Kullanıcıdan gelen tüm verileri `htmlspecialchars()` ile temizleyin
   - Output encoding yapın

4. **Session Güvenliği**
   - Session hijacking'e karşı session yenileme yapın
   - Güvenli session cookie ayarları kullanın

## 📋 Kurulum Öncesi Kontrol Listesi

### Geliştirme Ortamı
- [ ] XAMPP/WAMP kurulu
- [ ] Apache ve MySQL servisleri çalışıyor
- [ ] phpMyAdmin erişilebilir
- [ ] Git kurulu (GitHub için)

### İlk Kurulum
- [ ] `database_schema.sql` dosyası import edildi
- [ ] `php/ayar.example.php` dosyası `php/ayar.php` olarak kopyalandı
- [ ] Veritabanı bağlantı bilgileri güncellendi
- [ ] Test verisi eklendi (opsiyonel)

### Güvenlik Kontrolleri
- [ ] `.gitignore` dosyası doğru yapılandırıldı
- [ ] `php/ayar.php` dosyası Git'e eklenmedi
- [ ] Varsayılan admin şifresi değiştirildi
- [ ] Üretim ortamında `display_errors = Off` ayarlandı

## 🚀 GitHub'a Yükleme Adımları

### İlk Yükleme

```bash
# 1. Git repository başlat
cd "c:\Users\erayb\Documents\SoftwareDevelop\gitHub\rehberlikProje"
git init

# 2. İlk commit
git add .
git commit -m "feat: İlk commit - Rehberlik takip sistemi"

# 3. GitHub'da yeni repository oluşturun (web arayüzünden)

# 4. Remote repository ekleyin
git remote add origin https://github.com/KULLANICI_ADINIZ/rehberlikProje.git

# 5. Push edin
git branch -M main
git push -u origin main
```

### Güncellemeler

```bash
# Değişiklikleri kontrol et
git status

# Değişiklikleri ekle
git add .

# Commit et
git commit -m "fix: Hata düzeltmesi açıklaması"

# Push et
git push
```

## 🔐 Hassas Bilgi Yönetimi

### Asla GitHub'a Yüklenmemesi Gerekenler

1. **Veritabanı Bilgileri**
   - `php/ayar.php`
   - Veritabanı yedekleri (`.sql` dosyaları)

2. **Gerçek Kullanıcı Verileri**
   - Öğrenci bilgileri
   - Kişisel veriler
   - Veli bilgileri

3. **API Anahtarları ve Şifreler**
   - `.env` dosyaları
   - Herhangi bir API key veya secret

### Örnek (Template) Dosyaları
- `php/ayar.example.php` ✅ (GitHub'a yüklenebilir)
- `database_schema.sql` ✅ (Veri içermediği için güvenli)

## 📝 Veritabanı Yönetimi

### Yedekleme

```bash
# Veritabanı yedeği al (lokal)
mysqldump -u root -p ogrenci > backup_$(date +%Y%m%d).sql

# ÖNEMLİ: Bu yedekler GitHub'a yüklenMEMELİ
```

### Restore

```bash
# Yedeği geri yükle
mysql -u root -p ogrenci < backup_20250120.sql
```

## 🎯 En İyi Uygulamalar

### Kod Güvenliği

```php
// ✅ DOĞRU - Prepared Statement
$stmt = $baglanti->prepare("SELECT * FROM girdiler WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// ❌ YANLIŞ - SQL Injection riski
$query = "SELECT * FROM girdiler WHERE id = $id";
```

### Output Encoding

```php
// ✅ DOĞRU - XSS koruması
echo htmlspecialchars($ogrenci_adi, ENT_QUOTES, 'UTF-8');

// ❌ YANLIŞ - XSS riski
echo $ogrenci_adi;
```

### Session Yönetimi

```php
// ✅ DOĞRU - Güvenli session
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => true, // HTTPS kullanıyorsanız
    'use_strict_mode' => true
]);

// Session regeneration
session_regenerate_id(true);
```

## 🌐 Üretim Ortamı için Öneriler

1. **HTTPS Kullanın**
   - SSL sertifikası edinin
   - Tüm trafiği HTTPS'e yönlendirin

2. **Güçlü Şifreler**
   - Minimum 12 karakter
   - Büyük-küçük harf, rakam ve özel karakter

3. **Düzenli Güncellemeler**
   - PHP sürümünü güncel tutun
   - Güvenlik yamalarını uygulayın

4. **Yedekleme Stratejisi**
   - Günlük otomatik yedekler
   - Farklı lokasyonlarda saklama

5. **Erişim Kontrolü**
   - Rol bazlı yetkilendirme
   - IP kısıtlamaları (gerekirse)

## 📞 Destek ve Sorunlar

Güvenlik açığı bulursanız:
- **Public issue açMAYIN**
- Direkt proje sahibine bildirin
- Detaylı açıklama yapın

---

**Hatırlatma**: Bu bir eğitim projesidir. Gerçek öğrenci verileriyle kullanırken KVKK ve ilgili yasalara uygun hareket edin.
