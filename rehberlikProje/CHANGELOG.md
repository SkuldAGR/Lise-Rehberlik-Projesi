# Changelog

Projedeki tüm önemli değişiklikler bu dosyada belgelenecektir.

Format [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) standardına dayanır,
ve bu proje [Semantic Versioning](https://semver.org/spec/v2.0.0.html) kullanır.

## [Unreleased]

### Planlanan Özellikler
- [ ] Gelişmiş arama ve filtreleme
- [ ] PDF rapor çıktısı
- [ ] E-posta bildirimleri
- [ ] Çoklu kullanıcı yönetimi
- [ ] İstatistik dashboard'u
- [ ] Dosya ekleme özelliği

## [1.0.0] - 2025-12-20

### Added
- İlk sürüm yayınlandı
- Öğrenci görüşme ekleme özelligi
- Kayıt listeleme ve görüntüleme
- Kayıt düzenleme
- Kayıt silme
- Kullanıcı girişi
- Responsive tasarım
- Türkçe dil desteği
- Veritabanı şeması
- Kapsamlı dokümantasyon
  - README.md (Türkçe)
  - README_EN.md (İngilizce)
  - CONTRIBUTING.md
  - SECURITY.md
  - DEPLOYMENT_GUIDE.md
  - CHANGELOG.md

### Security
- SQL injection koruması için prepared statements
- XSS koruması için input sanitization
- Veritabanı bilgilerinin .gitignore ile korunması

## Versiyon Açıklamaları

### [1.0.0] - İlk Sürüm
Rehberlik Öğrenci Takip Sistemi'nin ilk kararlı sürümü. Temel CRUD (Create, Read, Update, Delete) işlemleri ve güvenli veritabanı yönetimi içerir.

---

### Değişiklik Tipleri
- `Added` - Yeni özellikler
- `Changed` - Mevcut özelliklerde değişiklikler
- `Deprecated` - Yakında kaldırılacak özellikler
- `Removed` - Kaldırılan özellikler
- `Fixed` - Hata düzeltmeleri
- `Security` - Güvenlik iyileştirmeleri
