<?php
    // Veritabanı Bağlantı Ayarları
    // Bu dosya GitHub'a yüklenmeyecektir (.gitignore ile engellenmiştir)
    // Gerçek bilgilerinizi buraya yazın
    
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
    
    // Karakter setini ayarla
    mysqli_set_charset($baglanti, "utf8mb4");
?>
