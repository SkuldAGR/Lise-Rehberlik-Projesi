# 🚀 GitHub'a Yükleme Rehberi

Bu rehber, Rehberlik Öğrenci Takip Sistemi projesini GitHub'a nasıl yükleyeceğinizi adım adım açıklar.

## 📋 Ön Hazırlık

### 1. Git Kurulumu

Eğer Git kurulu değilse:

1. [Git for Windows](https://git-scm.com/download/win) adresinden Git'i indirin
2. Kurulumu varsayılan ayarlarla yapın
3. Kurulum sonrası PowerShell veya CMD'yi yeniden başlatın

Git'in kurulu olduğunu kontrol edin:
```bash
git --version
```

### 2. GitHub Hesabı

1. [GitHub.com](https://github.com) üzerinde bir hesap oluşturun (yoksa)
2. Email adresinizi doğrulayın

## 🎯 Adım Adım GitHub'a Yükleme

### Adım 1: Git Yapılandırması

PowerShell veya CMD'de şu komutları çalıştırın:

```bash
git config --global user.name "Adınız Soyadınız"
git config --global user.email "email@example.com"
```

### Adım 2: Projeye Git Repository Başlatma

1. PowerShell veya CMD'yi açın
2. Proje klasörüne gidin:

```bash
cd "c:\Users\erayb\Documents\SoftwareDevelop\gitHub\rehberlikProje"
```

3. Git repository başlatın:

```bash
git init
```

### Adım 3: İlk Commit

```bash
# Tüm dosyaları stage'e ekle
git add .

# Durumu kontrol et
git status

# İlk commit'i yap
git commit -m "feat: İlk commit - Rehberlik öğrenci takip sistemi"
```

**Önemli**: `git status` çıktısında `php/ayar.php` dosyasının **GÖRÜNMEMESİ** gerekir. Eğer görünüyorsa `.gitignore` dosyası doğru çalışmıyor demektir.

### Adım 4: GitHub'da Repository Oluşturma

1. [GitHub](https://github.com) hesabınıza giriş yapın
2. Sağ üst köşedeki `+` işaretine tıklayın
3. `New repository` seçin
4. Repository bilgilerini doldurun:
   - **Repository name**: `rehberlikProje` (veya istediğiniz isim)
   - **Description**: "Okul rehberlik servisleri için öğrenci görüşme takip sistemi"
   - **Public** veya **Private** seçin
   - ✅ **ÖNEMLI**: "Add a README file" seçeneğini **İŞARETLEMEYİN** (zaten var)
   - ✅ **ÖNEMLI**: ".gitignore" eklemeyin (zaten var)
   - ✅ **ÖNEMLI**: "Choose a license" ekleyin: **MIT License** seçin
5. `Create repository` butonuna tıklayın

### Adım 5: Remote Repository Bağlantısı

GitHub'da oluşturduğunuz repository sayfasında gösterilen komutları kullanın:

```bash
# Remote ekle (KULLANICI_ADINIZ yerine kendi GitHub kullanıcı adınızı yazın)
git remote add origin https://github.com/KULLANICI_ADINIZ/rehberlikProje.git

# Ana branch'i main olarak ayarla
git branch -M main

# Push et
git push -u origin main
```

### Adım 6: Push İşlemi

İlk push sırasında GitHub kimlik bilgileriniz istenecektir:
- **Username**: GitHub kullanıcı adınız
- **Password**: GitHub şifreniz VEYA Personal Access Token (PAT)

**Not**: 2021'den sonra GitHub şifre yerine Personal Access Token (PAT) kullanımını zorunlu kıldı.

#### Personal Access Token (PAT) Oluşturma

1. GitHub'da: Settings → Developer settings → Personal access tokens → Tokens (classic)
2. "Generate new token" → "Generate new token (classic)"
3. Note: "rehberlikProje access"
4. Expiration: 90 days (veya istediğiniz süre)
5. Scopes: `repo` seçeneğini işaretleyin
6. "Generate token" butonuna tıklayın
7. **Token'ı kopyalayın** (bir daha gösterilmeyecek!)
8. Bu token'ı şifre yerine kullanın

## 🔄 Güncellemeleri GitHub'a Gönderme

Proje üzerinde değişiklik yaptıktan sonra:

```bash
# Mevcut durumu kontrol et
git status

# Değişiklikleri stage'e ekle
git add .

# Commit et (anlamlı bir mesaj yazın)
git commit -m "fix: Form validasyonu düzeltildi"

# GitHub'a gönder
git push
```

## 📝 Commit Mesajı İpuçları

İyi commit mesajları yazın:

- ✅ `feat: Yeni filtreleme özelliği eklendi`
- ✅ `fix: Tarih formatı hatası düzeltildi`
- ✅ `docs: README kurulum bölümü güncellendi`
- ❌ `update`
- ❌ `fix bug`
- ❌ `asdjkl`

## 🔍 Dosya Kontrolü

GitHub'a yüklenmeden önce şunları kontrol edin:

### ✅ Yüklenmesi Gerekenler
- [x] README.md
- [x] README_EN.md
- [x] LICENSE
- [x] CONTRIBUTING.md
- [x] SECURITY.md
- [x] .gitignore
- [x] database_schema.sql
- [x] php/ayar.example.php
- [x] Tüm HTML, CSS, JS dosyaları
- [x] Görseller (img klasörü)

### ❌ Yüklenmemesi Gerekenler
- [ ] php/ayar.php (hassas veritabanı bilgileri)
- [ ] *.sql yedek dosyaları
- [ ] .env dosyaları
- [ ] Gerçek öğrenci verileri

## 🌐 Repository'yi Görüntüleme

Push işlemi tamamlandıktan sonra:

1. `https://github.com/KULLANICI_ADINIZ/rehberlikProje` adresine gidin
2. README dosyanızı görüntüleyin
3. Tüm dosyaların doğru yüklendiğini kontrol edin

## 🎨 README'yi Özelleştirme

GitHub'a yükledikten sonra README.md dosyasında şunları güncelleyin:

1. **Kullanıcı Adınız**: `KULLANICI_ADINIZ` yerine gerçek GitHub kullanıcı adınızı yazın
2. **Email**: `eposta@example.com` yerine gerçek email adresinizi yazın
3. **Ekran Görüntüleri**: Projenizin ekran görüntülerini ekleyin
4. **LICENSE**: Copyright kısmında `[Your Name]` yerine adınızı yazın

## 🚨 Sorun Giderme

### "Git is not recognized" Hatası

**Çözüm**: Git'i kurduktan sonra PowerShell/CMD'yi yeniden başlatın.

### "Permission denied" Hatası

**Çözüm**: Personal Access Token (PAT) kullanın, şifre yerine.

### "php/ayar.php" Görünüyor

**Çözüm**: 
```bash
# Dosyayı Git tracking'den kaldır
git rm --cached php/ayar.php

# Commit et
git commit -m "chore: Hassas dosya kaldırıldı"

# Push et
git push
```

### ".gitignore" Çalışmıyor

**Çözüm**:
```bash
# Git cache'i temizle
git rm -r --cached .

# Yeniden ekle
git add .

# Commit et
git commit -m "fix: .gitignore düzeltildi"
```

## 📚 Ek Kaynaklar

- [Git Dokümantasyonu](https://git-scm.com/doc)
- [GitHub Guides](https://guides.github.com/)
- [Markdown Rehberi](https://guides.github.com/features/mastering-markdown/)

## ✨ Başarıyla Tamamlandı!

Artık projeniz GitHub'da! 🎉

Repository linkinizi:
- CV'nizde paylaşabilirsiniz
- LinkedIn'de belirtebilirsiniz
- İş başvurularında kullanabilirsiniz

---

**Sonraki Adımlar**:
1. README'ye ekran görüntüleri ekleyin
2. Projenizi geliştirmeye devam edin
3. Değişiklikleri düzenli olarak commit edin
4. README'de açık olan "Issues" bölümüne iyileştirme fikirleri ekleyin
