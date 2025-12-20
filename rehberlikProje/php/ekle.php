<?php
include("ayar.php");

// Formdan gelen verileri al
$isim_soyisim      = $_POST["isim_soyisim"];
$sinif             = $_POST["sinif"];
$okulno            = $_POST["okulno"];
$bireysel_grup     = $_POST["bireysel_grup"];
$rdp_hizmet        = $_POST["rdp_hizmet"];
$birinciasama      = $_POST["birinciasama"];
$ikinciasama       = $_POST["ikinciasama"];
$ucuncuasama       = $_POST["ucuncuasama"];
$tarih             = $_POST["tarih"];
$baslamasaati      = $_POST["baslamasaati"];
$bitissaati        = $_POST["bitissaati"];
$yapilanyer        = $_POST["yapilanyer"];
$oturumsayisi      = $_POST["oturumsayisi"];
$calismayontemi    = $_POST["calismayontemi"];
$ogr_davranis      = $_POST["ogr_davranis"];
$akrangorusmesi    = isset($_POST["akrangorusmesi"]) ? 1 : 0;
$aciklama          = $_POST["aciklama"];
$donem             = $_POST["donem"];

if ($bireysel_grup === 'Bireysel') {
    $sorgu = "INSERT INTO girdiler 
    (isim_soyisim, sinif, okulno, bireysel_grup, rdp_hizmet, birinciasama, ikinciasama, ucuncuasama, tarih, baslamasaati, bitissaati, yapilanyer, oturumsayisi, calismayontemi, ogr_davranis, akrangorusmesi, aciklama, donem)
    VALUES 
    ('$isim_soyisim', '$sinif', '$okulno', '$bireysel_grup', '$rdp_hizmet', '$birinciasama', '$ikinciasama', '$ucuncuasama', '$tarih', '$baslamasaati', '$bitissaati', '$yapilanyer', '$oturumsayisi', '$calismayontemi', '$ogr_davranis', '$akrangorusmesi', '$aciklama', '$donem')";
} else {
    // grup_aciklama inputunun formda olduğundan emin ol!
    $ogrencilerin_bilgileri = $_POST["grup_aciklama"];
    $sorgu = "INSERT INTO girdiler2 
    (bireysel_grup, rdp_hizmet, birinciasama, ikinciasama, ucuncuasama, tarih, baslamasaati, bitissaati, yapilanyer, oturumsayisi, calismayontemi, ogr_davranis, akrangorusmesi, aciklama, ogrencilerin_bilgileri, donem)
    VALUES 
    ('$bireysel_grup', '$rdp_hizmet', '$birinciasama', '$ikinciasama', '$ucuncuasama', '$tarih', '$baslamasaati', '$bitissaati', '$yapilanyer', '$oturumsayisi', '$calismayontemi', '$ogr_davranis', '$akrangorusmesi', '$aciklama', '$ogrencilerin_bilgileri', '$donem')";
}

$sonuc = mysqli_query($baglanti, $sorgu);
if ($sonuc) {
    header("Location: form.php?ekle=basarili");
    exit;
} else {
    echo "Hata oluştu: " . mysqli_error($baglanti);
}
?>
