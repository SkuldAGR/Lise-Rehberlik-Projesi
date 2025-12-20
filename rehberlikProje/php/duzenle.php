<?php
include("ayar.php");

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID bulunamadı.");
}

// Veri çekme
$sorgu = mysqli_query($baglanti, "SELECT * FROM girdiler WHERE id = $id");
$veri = mysqli_fetch_assoc($sorgu);

if (!$veri) {
    die("Kayıt bulunamadı.");
}

// Form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isim_soyisim = $_POST["isim_soyisim"];
    $sinif = $_POST["sinif"];
    $okul_no = $_POST["okul_no"];
    $bireysel_grup = $_POST["bireysel_grup"];
    $rdp_hizmet = $_POST["rdp_hizmet"];
    $birinciasama = $_POST["birinciasama"];
    $ikincisama = $_POST["ikincisama"];
    $ucuncuasama = $_POST["ucuncuasama"];
    $tarih = $_POST["tarih"];
    $baslamasaati = $_POST["baslamasaati"];
    $bitissaati = $_POST["bitissaati"];
    $yapilanyer = $_POST["yapilanyer"];
    $oturumsayisi = $_POST["oturumsayisi"];
    $calismayontemi = $_POST["calismayontemi"];
    $ogr_davranis = $_POST["ogr_davranis"];
    $akrangorusmesi = isset($_POST["akrangorusmesi"]) ? 1 : 0;
    $aciklama = $_POST["aciklama"];
    $donem = $_POST["donem"];

    $guncelle = "
        UPDATE girdiler SET
        isim_soyisim='$isim_soyisim',
        sinif='$sinif',
        okulno='$okul_no',
        bireysel_grup='$bireysel_grup',
        rdp_hizmet='$rdp_hizmet',
        birinciasama='$birinciasama',
        ikinciasama='$ikincisama',
        ucuncuasama='$ucuncuasama',
        tarih='$tarih',
        baslamasaati='$baslamasaati',
        bitissaati='$bitissaati',
        yapilanyer='$yapilanyer',
        oturumsayisi='$oturumsayisi',
        calismayontemi='$calismayontemi',
        ogr_davranis='$ogr_davranis',
        akrangorusmesi='$akrangorusmesi',
        aciklama='$aciklama',
        donem='$donem'
        WHERE id=$id
    ";

    if (mysqli_query($baglanti, $guncelle)) {
        // Başarıyla güncelleme yapıldı
        header("Location: listele.php");  // Listele sayfasına yönlendir
        exit; // Yönlendirme yapıldıktan sonra diğer işlemler engellenir
    } else {
        // Hata oluştu
        echo "Hata oluştu: " . mysqli_error($baglanti);
    }
    
}
?>

<!-- Formu göster -->
<link rel="stylesheet" href="../css/duzenle.css">

<form action="" method="POST">
    <h2>Bilgileri Düzenle</h2>

    <!-- Öğrenci Bilgileri -->
    <label>İsim Soyisim:</label>
    <input type="text" name="isim_soyisim" value="<?= $veri['isim_soyisim'] ?? '' ?>"><br>

    <label>Sınıf:</label>
    <input type="text" name="sinif" value="<?= $veri['sinif'] ?? '' ?>"><br>

    <label>Okul No:</label>
    <input type="text" name="okul_no" value="<?= $veri['okulno'] ?? '' ?>"><br>

    <hr>

    <!-- Görüşme Ayrıntıları -->
    <label>Bireysel / Grup:</label>
    <select name="bireysel_grup">
        <option value="Bireysel" <?= $veri['bireysel_grup'] == 'Bireysel' ? 'selected' : '' ?>>Bireysel</option>
        <option value="Grup" <?= $veri['bireysel_grup'] == 'Grup' ? 'selected' : '' ?>>Grup</option>
    </select><br><br>

    <label>RDP Hizmet Türü:</label>
    <select name="rdp_hizmet">
        <option value="Bireysel Görüşme" <?= $veri['rdp_hizmet'] == 'Bireysel Görüşme' ? 'selected' : '' ?>>Bireysel Görüşme</option>
        <option value="Eğitsel Rehberlik" <?= $veri['rdp_hizmet'] == 'Eğitsel Rehberlik' ? 'selected' : '' ?>>Eğitsel Rehberlik</option>
    </select><br><br>

    <label>1. Aşama:</label>
    <select name="birinciasama">
        <option value="Hazırlık" <?= $veri['birinciasama'] == 'Hazırlık' ? 'selected' : '' ?>>Hazırlık</option>
        <option value="Planlama" <?= $veri['birinciasama'] == 'Planlama' ? 'selected' : '' ?>>Planlama</option>
        <option value="Uygulama" <?= $veri['birinciasama'] == 'Uygulama' ? 'selected' : '' ?>>Uygulama</option>
    </select><br><br>

    <label>2. Aşama:</label>
    <select name="ikincisama">
        <option value="Gözlem" <?= $veri['ikinciasama'] == 'Gözlem' ? 'selected' : '' ?>>Gözlem</option>
        <option value="Değerlendirme" <?= $veri['ikinciasama'] == 'Değerlendirme' ? 'selected' : '' ?>>Değerlendirme</option>
        <option value="İzleme" <?= $veri['ikinciasama'] == 'İzleme' ? 'selected' : '' ?>>İzleme</option>
    </select><br><br>

    <label>3. Aşama:</label>
    <select name="ucuncuasama">
        <option value="Sonuçlandırma" <?= $veri['ucuncuasama'] == 'Sonuçlandırma' ? 'selected' : '' ?>>Sonuçlandırma</option>
        <option value="Raporlama" <?= $veri['ucuncuasama'] == 'Raporlama' ? 'selected' : '' ?>>Raporlama</option>
        <option value="Geribildirim" <?= $veri['ucuncuasama'] == 'Geribildirim' ? 'selected' : '' ?>>Geribildirim</option>
    </select><br><br>

    <label>Görüşme Tarihi:</label>
    <input type="date" name="tarih" value="<?= $veri['tarih'] ?? '' ?>"><br><br>

    <label>Başlama Saati:</label>
    <input type="time" name="baslamasaati" value="<?= $veri['baslamasaati'] ?? '' ?>"><br><br>

    <label>Bitiş Saati:</label>
    <input type="time" name="bitissaati" value="<?= $veri['bitissaati'] ?? '' ?>"><br><br>

    <label>Yapıldığı Yer:</label>
    <input type="text" name="yapilanyer" value="<?= $veri['yapilanyer'] ?? '' ?>"><br><br>

    <label>Oturum Sayısı:</label>
    <input type="number" name="oturumsayisi" value="<?= $veri['oturumsayisi'] ?? '' ?>"><br><br>

    <label>Çalışma Yöntemi:</label><br>
    <input type="radio" name="calismayontemi" value="Yüz Yüze" <?= $veri['calismayontemi'] == 'Yüz Yüze' ? 'checked' : '' ?>>Yüz Yüze
    <input type="radio" name="calismayontemi" value="Uzaktan" <?= $veri['calismayontemi'] == 'Uzaktan' ? 'checked' : '' ?>>Uzaktan<br><br>

    <label>Öğrenci Davranış Değişikliği:</label>
    <select name="ogr_davranis">
        <option value="Kurula Sevk" <?= $veri['ogr_davranis'] == 'Kurula Sevk' ? 'selected' : '' ?>>Kurula Sevk</option>
        <option value="Şahitlik" <?= $veri['ogr_davranis'] == 'Şahitlik' ? 'selected' : '' ?>>Şahitlik</option>
    </select><br><br>


    <label class="akrangorusmesi">
    <input type="checkbox" name="akrangorusmesi" value="1" value="1" <?= $veri['akrangorusmesi'] == 1 ? 'checked' : '' ?> >
    <span>Akran Görüşmesi = </span>
    </label> <br><br>


    <label>Açıklama:</label><br>
    <textarea name="aciklama" rows="4" cols="40"><?= $veri['aciklama'] ?? '' ?></textarea><br><br>

    <label>Dönem:</label>
    <input type="text" name="donem" value="<?= $veri['donem'] ?? '' ?>"><br><br>

    <div class="button-group">
        <button type="submit">Kaydet</button>
        <a href="listele.php" class="temizle-btn">İptal</a>
    </div>
</form>
