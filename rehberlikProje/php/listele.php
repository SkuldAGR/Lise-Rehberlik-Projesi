<?php
// Veritabanı bağlantısını yapalım
include("ayar.php");

// Filtre parametrelerini al
$filtre_okulno = isset($_GET['okulno']) ? $_GET['okulno'] : '';
$filtre_isim = isset($_GET['isim_soyisim']) ? $_GET['isim_soyisim'] : '';

// SQL sorgusunu oluştur
// 1. Tablo: Bireysel Görüşmeler (girdiler)
$sorgu1 = "SELECT * FROM girdiler WHERE 1=1";
if (!empty($filtre_okulno)) {
    $filtre_okulno = mysqli_real_escape_string($baglanti, $filtre_okulno);
    $sorgu1 .= " AND okulno = '$filtre_okulno'";
}
if (!empty($filtre_isim)) {
    $filtre_isim = mysqli_real_escape_string($baglanti, $filtre_isim);
    $sorgu1 .= " AND isim_soyisim LIKE '%$filtre_isim%'";
}

// 2. Tablo: Grup Görüşmeleri (girdiler2)
$sorgu2 = "SELECT * FROM girdiler2 WHERE 1=1";
if (!empty($filtre_okulno)) {
    $filtre_okulno = mysqli_real_escape_string($baglanti, $filtre_okulno);
    $sorgu2 .= " AND ogrencilerin_bilgileri LIKE '%$filtre_okulno%'";
}
if (!empty($filtre_isim)) {
    $filtre_isim = mysqli_real_escape_string($baglanti, $filtre_isim);
    $sorgu2 .= " AND ogrencilerin_bilgileri LIKE '%$filtre_isim%'";
}

// Sonuçları al
$sonuc1 = mysqli_query($baglanti, $sorgu1);
$sonuc2 = mysqli_query($baglanti, $sorgu2);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Görüşme Listesi</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 40px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .filtre-formu { margin-bottom: 20px; }
    </style>
    <link rel="stylesheet" href="../css/listele.css">
</head>
<body>
    <h2>Görüşme Kayıtları</h2>

    <!-- Filtre Formu -->
    <form class="filtre-formu" method="GET" action="listele.php">
        <label>Okul No:</label>
        <input type="text" name="okulno" value="<?php echo htmlspecialchars($filtre_okulno); ?>">
        
        <label>İsim Soyisim:</label>
        <input type="text" name="isim_soyisim" value="<?php echo htmlspecialchars($filtre_isim); ?>">

        <div class="filtre-butons">
            <button type="submit" class="filtrele-btn">Filtrele</button>
            <button type="button" class="temizle-btn" onclick="window.location.href='listele.php'">Temizle</button>
            <button type="button" class="geri-btn" onclick="window.location.href='form.php'">Geri Dön</button>
        </div>
    </form>

    <!-- TABLO 1: Bireysel Görüşmeler -->
    <h3>Bireysel Görüşmeler</h3>
    <table>
        <thead>
            <tr>
                <th>İşlem</th>
                <th>İsim Soyisim</th>
                <th>Sınıf</th>
                <th>Okul No</th>
                <th>Bireysel/Grup</th>
                <th>RDP Hizmet</th>
                <th>1. Aşama</th>
                <th>2. Aşama</th>
                <th>3. Aşama</th>
                <th>Tarih</th>
                <th>Başlama Saati</th>
                <th>Bitiş Saati</th>
                <th>Yapıldığı Yer</th>
                <th>Oturum Sayısı</th>
                <th>Çalışma Yöntemi</th>
                <th>Öğrenci Davranış Değişikliği</th>
                <th>Akran Görüşmesi</th>
                <th>Dönem</th>
                <th>Açıklama</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($sonuc1) > 0) {
            while ($row = mysqli_fetch_assoc($sonuc1)) {
                echo "<tr>";
                echo "<td>
                    <a href='duzenle.php?id=" . $row['id'] . "' class='duzenle-btn btn-turuncu'>Düzenle</a>
                    <a href='sil.php?id=" . $row['id'] . "' class='sil-btn btn-kirmizi' onclick=\"return confirm('Bu kaydı silmek istediğine emin misin?');\">Sil</a>
                </td>";
                echo "<td>" . htmlspecialchars($row['isim_soyisim']) . "</td>";
                echo "<td>" . htmlspecialchars($row['sinif']) . "</td>";
                echo "<td>" . htmlspecialchars($row['okulno']) . "</td>";
                echo "<td>" . htmlspecialchars($row['bireysel_grup']) . "</td>";
                echo "<td>" . htmlspecialchars($row['rdp_hizmet']) . "</td>";
                echo "<td>" . htmlspecialchars($row['birinciasama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ikinciasama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ucuncuasama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tarih']) . "</td>";
                echo "<td>" . htmlspecialchars($row['baslamasaati']) . "</td>";
                echo "<td>" . htmlspecialchars($row['bitissaati']) . "</td>";
                echo "<td>" . htmlspecialchars($row['yapilanyer']) . "</td>";
                echo "<td>" . htmlspecialchars($row['oturumsayisi']) . "</td>";
                echo "<td>" . htmlspecialchars($row['calismayontemi']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ogr_davranis']) . "</td>";
                echo "<td>" . ($row['akrangorusmesi'] ? 'Evet' : 'Hayır') . "</td>";
                echo "<td>" . htmlspecialchars($row['donem']) . "</td>";
                echo "<td>" . nl2br(htmlspecialchars($row['aciklama'])) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='19'>Kayıt bulunamadı.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- TABLO 2: Grup Görüşmeleri -->
<h3>Grup Görüşmeleri</h3>
<table>
    <thead>
        <tr>
            <th>İşlem</th>
            <th>Öğrenci Bilgileri</th>
            <th>Bireysel/Grup</th>
            <th>RDP Hizmet</th>
            <th>1. Aşama</th>
            <th>2. Aşama</th>
            <th>3. Aşama</th>
            <th>Tarih</th>
            <th>Başlama Saati</th>
            <th>Bitiş Saati</th>
            <th>Yapıldığı Yer</th>
            <th>Oturum Sayısı</th>
            <th>Çalışma Yöntemi</th>
            <th>Davranış Değişikliği</th>
            <th>Akran Görüşmesi</th>
            <th>Dönem</th>
            <th>Açıklama</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($sonuc2) > 0) {
            while ($row = mysqli_fetch_assoc($sonuc2)) {
                echo "<tr>";
                echo "<td>
                        <a href='duzenle_grup.php?id=" . $row['id'] . "' class='duzenle-btn btn-turuncu'>Düzenle</a>
                        <a href='sil_grup.php?id=" . $row['id'] . "' class='sil-btn btn-kirmizi' onclick=\"return confirm('Bu kaydı silmek istediğine emin misin?');\">Sil</a>
                      </td>";
                echo "<td>" . nl2br(htmlspecialchars($row['ogrencilerin_bilgileri'])) . "</td>";
                echo "<td>" . htmlspecialchars($row['bireysel_grup']) . "</td>";
                echo "<td>" . htmlspecialchars($row['rdp_hizmet']) . "</td>";
                echo "<td>" . htmlspecialchars($row['birinciasama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ikinciasama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ucuncuasama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tarih']) . "</td>";
                echo "<td>" . htmlspecialchars($row['baslamasaati']) . "</td>";
                echo "<td>" . htmlspecialchars($row['bitissaati']) . "</td>";
                echo "<td>" . htmlspecialchars($row['yapilanyer']) . "</td>";
                echo "<td>" . htmlspecialchars($row['oturumsayisi']) . "</td>";
                echo "<td>" . htmlspecialchars($row['calismayontemi']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ogr_davranis']) . "</td>";
                echo "<td>" . ($row['akrangorusmesi'] ? 'Evet' : 'Hayır') . "</td>";
                echo "<td>" . htmlspecialchars($row['donem']) . "</td>";
                echo "<td>" . nl2br(htmlspecialchars($row['aciklama'])) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='17'>Kayıt bulunamadı.</td></tr>";
        }
        ?>
    </tbody>
</table>


</body>
</html>
