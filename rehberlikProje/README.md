# 🎓 Rehberlik Öğrenci Takip Sistemi

Okul rehberlik servislerinin öğrenci görüşmelerini sistematik bir şekilde kaydetmesi ve takip etmesi için geliştirilmiş web tabanlı bir yönetim sistemidir.

## 📋 İçindekiler

- [Özellikler](#-özellikler)
- [Teknolojiler](#-teknolojiler)
- [Kurulum](#-kurulum)
- [Kullanım](#-kullanım)
- [Proje Yapısı](#-proje-yapısı)
- [Veritabanı Yapısı](#-veritabanı-yapısı)
- [Ekran Görüntüleri](#-ekran-görüntüleri)
- [Katkıda Bulunma](#-katkıda-bulunma)
- [Lisans](#-lisans)
- [İletişim](#-iletişim)

## ✨ Özellikler

- ✅ **Görüşme Ekleme**: Öğrenci görüşmelerini detaylı bir şekilde kaydetme
- 📊 **Kayıt Listeleme**: Tüm görüşmeleri görüntüleme ve filtreleme
- ✏️ **Düzenleme**: Mevcut kayıtları güncelleme
- 🗑️ **Silme**: Gereksiz kayıtları kaldırma
- 🔐 **Güvenli Giriş**: Kullanıcı kimlik doğrulama sistemi
- 📱 **Responsive Tasarım**: Mobil ve masaüstü uyumlu arayüz
- 🎨 **Modern UI/UX**: Kullanıcı dostu ve modern tasarım

## 🛠 Teknolojiler

### Frontend
- **HTML5** - Yapısal işaretleme
- **CSS3** - Stil ve tasarım
- **JavaScript (ES6+)** - İstemci tarafı etkileşimler

### Backend
- **PHP** - Sunucu tarafı programlama
- **MySQL** - Veritabanı yönetimi

### Geliştirme Ortamı
- **XAMPP/WAMP** veya benzeri yerel sunucu
- Modern web tarayıcı (Chrome, Firefox, Edge vb.)

## 🚀 Kurulum

### Ön Gereksinimler

1. **XAMPP/WAMP** kurulu olmalı
2. **Apache** ve **MySQL** servisleri çalışır durumda olmalı
3. Modern bir web tarayıcı

### Adım Adım Kurulum

1. **Projeyi İndirin**
   ```bash
   git clone https://github.com/KULLANICI_ADINIZ/rehberlikProje.git
   ```

2. **Proje Klasörünü Web Sunucuya Taşıyın**
   ```bash
   # XAMPP kullanıyorsanız
   cp -r rehberlikProje C:/xampp/htdocs/rehberlik
   
   # veya WAMP kullanıyorsanız
   cp -r rehberlikProje C:/wamp64/www/rehberlik
   ```

3. **Veritabanını Oluşturun**
   - phpMyAdmin'e gidin: `http://localhost/phpmyadmin`
   - Yeni bir veritabanı oluşturun: `ogrenci`
   - Aşağıdaki SQL sorgusunu çalıştırın:

   ```sql
   CREATE DATABASE IF NOT EXISTS ogrenci;
   USE ogrenci;

   CREATE TABLE IF NOT EXISTS girdiler (
       id INT AUTO_INCREMENT PRIMARY KEY,
       tarih DATE NOT NULL,
       saat TIME NOT NULL,
       ogrenci_adi VARCHAR(100) NOT NULL,
       sinif VARCHAR(20) NOT NULL,
       veli_adi VARCHAR(100),
       gorusme_turu VARCHAR(50),
       konu TEXT,
       asama VARCHAR(50),
       notlar TEXT,
       olusturma_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       guncellenme_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
   ```

4. **Veritabanı Bağlantı Ayarlarını Yapılandırın**
   - `php/ayar.php` dosyasını açın
   - Gerekirse veritabanı bilgilerinizi güncelleyin:
   ```php
   $host = "localhost";
   $kullanici = "root";
   $sifre = "";
   $veritabani = "ogrenci";
   ```

5. **Uygulamayı Başlatın**
   - Tarayıcınızda şu adresi açın: `http://localhost/rehberlik/html/giris.html`

## 📖 Kullanım

### Giriş Yapma
1. Tarayıcınızda uygulamayı açın
2. Kullanıcı adı ve şifrenizi girin
3. "Giriş Yap" butonuna tıklayın

### Yeni Görüşme Ekleme
1. Ana sayfadan "Görüşme Ekle" butonuna tıklayın
2. Formu doldurun:
   - Tarih ve saat
   - Öğrenci bilgileri
   - Görüşme türü ve konusu
   - İlgili notlar
3. "Kaydet" butonuna tıklayın

### Kayıtları Görüntüleme
1. Ana sayfadan "Kayıtları Listele" butonuna tıklayın
2. Tüm görüşme kayıtlarını görüntüleyin
3. İsterseniz arama ve filtreleme yapın

### Kayıt Düzenleme
1. Listede düzenlemek istediğiniz kaydın "Düzenle" butonuna tıklayın
2. Gerekli değişiklikleri yapın
3. "Güncelle" butonuna tıklayın

### Kayıt Silme
1. Listede silmek istediğiniz kaydın "Sil" butonuna tıklayın
2. Onay mesajını kabul edin

## 📁 Proje Yapısı

```
rehberlikProje/
│
├── css/                    # Stil dosyaları
│   ├── duzenle.css        # Düzenleme sayfası stilleri
│   ├── form.css           # Form stilleri
│   ├── giris.css          # Giriş sayfası stilleri
│   ├── listele.css        # Listeleme sayfası stilleri
│   └── main.css           # Ana sayfa stilleri
│
├── html/                   # HTML sayfaları
│   ├── giris.html         # Giriş sayfası
│   └── main.html          # Ana sayfa
│
├── img/                    # Görseller
│   └── user-icon.png      # Kullanıcı ikonu
│
├── php/                    # PHP dosyaları
│   ├── ayar.php           # Veritabanı bağlantı ayarları
│   ├── duzenle.php        # Kayıt düzenleme işlemleri
│   ├── ekle.php           # Kayıt ekleme işlemleri
│   ├── form.php           # Form sayfası
│   ├── listele.php        # Kayıtları listeleme
│   └── sil.php            # Kayıt silme işlemleri
│
├── script/                 # JavaScript dosyaları
│   ├── asamalar.js        # Aşama yönetimi
│   ├── form.js            # Form etkileşimleri
│   └── giris.js           # Giriş sayfası işlemleri
│
├── .gitignore             # Git ignore dosyası
└── README.md              # Proje dokümantasyonu
```

## 🗄 Veritabanı Yapısı

### `girdiler` Tablosu

| Alan | Tür | Açıklama |
|------|-----|----------|
| `id` | INT (Primary Key) | Benzersiz kayıt numarası |
| `tarih` | DATE | Görüşme tarihi |
| `saat` | TIME | Görüşme saati |
| `ogrenci_adi` | VARCHAR(100) | Öğrencinin adı soyadı |
| `sinif` | VARCHAR(20) | Öğrencinin sınıfı |
| `veli_adi` | VARCHAR(100) | Veli adı soyadı |
| `gorusme_turu` | VARCHAR(50) | Görüşme türü |
| `konu` | TEXT | Görüşme konusu |
| `asama` | VARCHAR(50) | İşlem aşaması |
| `notlar` | TEXT | Ek notlar |
| `olusturma_tarihi` | TIMESTAMP | Kaydın oluşturulma zamanı |
| `guncellenme_tarihi` | TIMESTAMP | Kaydın son güncellenme zamanı |

## 📸 Ekran Görüntüleri

_(Ekran görüntülerinizi buraya ekleyebilirsiniz)_

## 🤝 Katkıda Bulunma

Katkılarınızı bekliyoruz! Katkıda bulunmak için:

1. Bu repo'yu fork edin
2. Yeni bir branch oluşturun (`git checkout -b feature/YeniOzellik`)
3. Değişikliklerinizi commit edin (`git commit -m 'Yeni özellik: Açıklama'`)
4. Branch'inizi push edin (`git push origin feature/YeniOzellik`)
5. Pull Request açın

### Katkı Kuralları
- Kod standartlarına uyun
- Anlamlı commit mesajları yazın
- Değişikliklerinizi test edin
- README'yi gerektiğinde güncelleyin

## 📝 Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Detaylar için [LICENSE](LICENSE) dosyasına bakın.

## 📧 İletişim

Sorularınız veya önerileriniz için:

- **GitHub**: [@KULLANICI_ADINIZ](https://github.com/KULLANICI_ADINIZ)
- **E-posta**: eposta@example.com

---

⭐ Bu projeyi beğendiyseniz yıldız vermeyi unutmayın!

**Not**: Bu proje eğitim ve rehberlik hizmetlerinin iyileştirilmesi amacıyla geliştirilmiştir. Gerçek öğrenci verileriyle kullanırken gizlilik ve güvenlik önlemlerine dikkat edin.
