<?php
    $host = "localhost";
    $kullanici = "root";
    $sifre = "";
    $veritabani = "ogrenci";
    $tablo = "girdiler";

    // Bağlantıyı oluştur
    $baglanti = mysqli_connect($host, $kullanici, $sifre, $veritabani);

    // Bağlantı hatası varsa
    if (!$baglanti) {
        die("Veritabanına bağlanırken bir hata oluştu: " . mysqli_connect_error());
    }

    // Tabloyu seçme (aslında burada veritabanı zaten seçilmiş olmalı)
    // @mysqli_select_db($baglanti, $veritabani) or die("Veri tabanına bağlanamadık.");
?>
