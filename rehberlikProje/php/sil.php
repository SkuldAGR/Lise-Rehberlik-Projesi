<?php
include("ayar.php");  // Veritabanı bağlantısını dahil et

// ID parametresi var mı diye kontrol et
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // ID'yi güvenli hale getir
    $id = mysqli_real_escape_string($baglanti, $id);

    // Silme sorgusunu hazırla
    $sorgu = "DELETE FROM girdiler WHERE id = '$id'";

    // Sorguyu çalıştır
    if (mysqli_query($baglanti, $sorgu)) {
        // Silme başarılı ise, listeleme sayfasına yönlendir
        header("Location: listele.php?sil=basarili");
        exit;
    } else {
        // Silme başarısız ise hata mesajı
        echo "Hata: " . mysqli_error($baglanti);
    }
} else {
    // ID yoksa, listeleme sayfasına yönlendir
    header("Location: listele.php");
    exit;
}
?>
