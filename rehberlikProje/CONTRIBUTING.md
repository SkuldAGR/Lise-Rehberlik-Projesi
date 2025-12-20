# Katkıda Bulunma Rehberi

Rehberlik Öğrenci Takip Sistemi projesine katkıda bulunmak istediğiniz için teşekkür ederiz! Bu doküman, projeye nasıl katkıda bulunabileceğinizi açıklar.

## 🤝 Nasıl Katkıda Bulunabilirsiniz?

### Hata Bildirimi

Bir hata bulduysanız:

1. Önce [Issues](../../issues) sayfasında benzer bir sorunun bildirilip bildirilmediğini kontrol edin
2. Eğer yoksa, yeni bir issue açın ve şunları ekleyin:
   - Hatanın açık bir tanımı
   - Hatayı yeniden üretme adımları
   - Beklenen davranış
   - Gerçekleşen davranış
   - Ekran görüntüleri (varsa)
   - Tarayıcı/işletim sistemi bilgileri

### Özellik Önerisi

Yeni bir özellik önermek için:

1. [Issues](../../issues) sayfasında benzer bir önerinin olup olmadığını kontrol edin
2. Yeni bir issue açın ve şunları belirtin:
   - Özelliğin detaylı açıklaması
   - Bu özelliğin neden gerekli olduğu
   - Mümkünse örnek kullanım senaryoları
   - İsteğe bağlı olarak tasarım önerileri

### Kod Katkısı

1. **Repository'yi Fork Edin**
   ```bash
   # GitHub üzerinden projeyi fork edin
   git clone https://github.com/SIZIN_KULLANICI_ADINIZ/rehberlikProje.git
   cd rehberlikProje
   ```

2. **Yeni Bir Branch Oluşturun**
   ```bash
   git checkout -b feature/yeni-ozellik
   # veya
   git checkout -b fix/hata-duzeltmesi
   ```

3. **Değişikliklerinizi Yapın**
   - Kod standartlarına uyun (aşağıya bakın)
   - Anlamlı commit mesajları yazın
   - Mümkünse testler ekleyin

4. **Commit Edin**
   ```bash
   git add .
   git commit -m "feat: Yeni özellik eklendi"
   # veya
   git commit -m "fix: Hata düzeltildi"
   ```

5. **Push Edin**
   ```bash
   git push origin feature/yeni-ozellik
   ```

6. **Pull Request Açın**
   - GitHub'da Pull Request oluşturun
   - Değişikliklerinizi açıklayın
   - İlgili issue'lara referans verin

## 📝 Kod Standartları

### PHP

- PSR-12 kodlama standartlarına uyun
- Değişken ve fonksiyon isimleri Türkçe veya İngilizce olabilir, ancak tutarlı olun
- Her fonksiyona açıklayıcı yorumlar ekleyin
- SQL injection'a karşı prepared statements kullanın

```php
// İyi Örnek
function ogrenciGetir($id) {
    global $baglanti;
    $stmt = $baglanti->prepare("SELECT * FROM girdiler WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

// Kötü Örnek
function ogrenciGetir($id) {
    global $baglanti;
    $query = "SELECT * FROM girdiler WHERE id = $id"; // SQL injection riski!
    return mysqli_query($baglanti, $query);
}
```

### JavaScript

- ES6+ syntax kullanın
- `const` ve `let` kullanın, `var` kullanmayın
- Arrow functions tercih edin
- Anlamlı değişken isimleri kullanın

```javascript
// İyi Örnek
const fetchStudentData = async (studentId) => {
    try {
        const response = await fetch(`/api/students/${studentId}`);
        return await response.json();
    } catch (error) {
        console.error('Hata:', error);
    }
};

// Kötü Örnek
var getData = function(id) {
    // Eski syntax
}
```

### CSS

- BEM metodolojisini kullanın (Block Element Modifier)
- Anlamlı class isimleri kullanın
- CSS değişkenleri (custom properties) kullanın
- Mobile-first yaklaşımı benimseyin

```css
/* İyi Örnek */
:root {
    --primary-color: #4CAF50;
    --secondary-color: #FF9800;
}

.student-card {
    /* Block */
}

.student-card__name {
    /* Element */
}

.student-card--highlighted {
    /* Modifier */
}
```

### HTML

- Semantic HTML kullanın
- Erişilebilirlik (accessibility) standartlarına uyun
- Uygun ARIA etiketleri ekleyin

```html
<!-- İyi Örnek -->
<article class="student-record" role="article">
    <header class="student-record__header">
        <h2 class="student-record__title">Öğrenci Adı</h2>
    </header>
    <main class="student-record__content">
        <!-- İçerik -->
    </main>
</article>
```

## 📋 Commit Mesajı Formatı

Semantic commit mesajları kullanın:

- `feat:` Yeni özellik
- `fix:` Hata düzeltmesi
- `docs:` Dokümantasyon değişikliği
- `style:` Kod formatı değişikliği (mantık değişikliği yok)
- `refactor:` Kod refactoring
- `test:` Test ekleme veya düzeltme
- `chore:` Build işlemleri veya yardımcı araç değişiklikleri

Örnek:
```
feat: Öğrenci arama fonksiyonu eklendi
fix: Tarih formatı hatası düzeltildi
docs: README kurulum bölümü güncellendi
```

## 🧪 Test Etme

Değişikliklerinizi göndermeden önce:

1. **Manuel Test**
   - Tüm sayfaları farklı tarayıcılarda test edin
   - Mobil görünümü kontrol edin
   - Form validasyonlarını test edin

2. **Kod Kontrolü**
   - PHP syntax hatalarını kontrol edin
   - Console'da JavaScript hatası olmadığından emin olun
   - CSS'in responsive olduğunu doğrulayın

3. **Veritabanı**
   - Veritabanı işlemlerinin doğru çalıştığını kontrol edin
   - SQL sorgularının güvenli olduğundan emin olun

## 🔒 Güvenlik

Güvenlik açığı bulduysanız:

1. **LÜTFEN public issue AÇMAYIN**
2. Doğrudan proje sahibine e-posta gönderin
3. Sorunu detaylı bir şekilde açıklayın
4. Mümkünse bir çözüm önerisi sunun

## 📞 İletişim

Sorularınız için:

- GitHub Issues kullanın
- Tartışmalar için Discussions kullanın
- Acil durumlar için e-posta gönderin

## 🎉 Teşekkürler!

Katkılarınız için şimdiden teşekkür ederiz. Her katkı, projeyi daha iyi hale getirir!

---

**Not**: İlk katkınız mı? Gitmek için harika bir yer! Küçük değişikliklerle başlayın ve kodla kendinizi rahat hissedin.
