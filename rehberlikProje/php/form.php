<?php
include("ayar.php");

if (isset($_GET['ajax']) && $_GET['ajax'] == 1 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // filtreler...
    // ---------- Bireysel ----------
    $sorgu1 = "SELECT * FROM girdiler WHERE 1=1";
    // ... filtre ekleme kodun olduğu yer ...
    $res1 = mysqli_query($baglanti, $sorgu1);
    $bireysel = [];
    while ($r = mysqli_fetch_assoc($res1)) $bireysel[] = $r;

    // ---------- Grup ----------
    $res2 = mysqli_query($baglanti, "SELECT * FROM girdiler2 ORDER BY tarih DESC");
    $grup = [];
    while ($r2 = mysqli_fetch_assoc($res2)) $grup[] = $r2;

    header('Content-Type: application/json');
    echo json_encode([
      'bireysel' => $bireysel,
      'grup'     => $grup
    ]);
    exit;
}

?>



<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Görüşme Ekleme</title>
  <link rel="stylesheet" href="../css/form.css">
  <style>
    #arama-sonuclari { display: none; }
    #form { display: none; margin-top: 20px; }
  </style>
</head>
<body>

<div id="icerik-wrapper">
  
  <!-- Arama Alanı -->
  <div id="arama-alani">
    <h2>Öğrenci Arama</h2>
    <form id="arama-form">
      <label>Öğrenci İsim Soyisim:</label>
      <input type="text" name="isim_soyisim" id="isim_soyisim">

      <label>Sınıf:</label>
      <input type="text" name="sinif" id="sinif">

      <label>Okul No:</label>
      <input type="number" name="okulno" id="okulno">

      <div style="text-align:center; margin:20px 0;">
        <button id="ara" type="button" style="background:orange; color:#fff;" onclick="kopyala()">Ara</button>
        <button type="button" onclick="window.location.href='listele.php'" style="background-color:'yellow'">Öğrencileri Listele</button>
      </div>
    </form>
  </div>

  <!-- Arama Sonuçları -->
  <div id="arama-sonuclari"></div>

  <div id="grup-sonuclari" class="sonuclar-wrapper" style="display:none;"></div>
  
 <!-- Grup Konuşmaları -->

   <div id="form-grup-sonuclari" class="sonuclar-wrapper" style="display:none;"></div>

  <!-- Diğer Alanlar: Form -->
  <div id="form">
    <h2>Yeni Görüşme Ekleme</h2>
    <form action="ekle.php" method="POST" onsubmit="return true;">


      <label>Bireysel / Grup:</label>
      <bold><input type="radio" name="bireysel_grup" value="Bireysel" required onclick="toggleForm()">Bireysel</bold>
      <bold><input type="radio" name="bireysel_grup" value="Grup" required onclick="toggleForm()">Grup</bold><br><br>


      <label for="form_isim_soyisim">Öğrenci İsim Soyisim:</label>
      <input type="text" name="isim_soyisim" id="form_isim_soyisim" >

      <label for="form_sinif">Sınıf:</label>
      <input type="text" name="sinif" id="form_sinif" >

      <label for="form_okulno">Okul No:</label>
      <input type="number" name="okulno" id="form_okulno" >

      <div id="textarea-container" style="display: none;">
        <label for="form_grup_acıklama">Öğrencilerin Bilgileri</label>
        <textarea name="grup_aciklama" id="form_grup_aciklama" name="grup_aciklama" rows="4" cols="50"></textarea>
      </div>


      <label>RDP Hizmet Türü:</label>
      <bold><input type="radio" name="rdp_hizmet" value="D-Destek_Hizmetler" required onclick="rdpSecildi('D')">D - Destek Hizmetler</bold>
      <bold><input type="radio" name="rdp_hizmet" value="İ-İyileştirici_hizmetler" required onclick="rdpSecildi('İ')">İ - İyileştici Hizmetler</bold>
      <bold><input type="radio" name="rdp_hizmet" value="Ö-Gelişimsel_Ve_Önleyici_Hizmetler" required onclick="rdpSecildi('Ö')">Ö - Gelişimsel Ve Önleyici Hizmetler</bold>


      <label>1. Aşama:</label>
      <select name="birinciasama" onchange="birinciAsamaSecildi(this.value)">
        <option value="">Seçiniz</option>
      </select>

      <label>2. Aşama:</label>
      <select name="ikinciasama" onchange="ikinciAsamaSecildi(this.value)">
        <option value="">Seçiniz</option>

      </select>

      <label>3. Aşama:</label>
      <select name="ucuncuasama">
        <option value="">Seçiniz</option>

      </select>

      <label for="gorusme-tarihi">Görüşme Tarihi:</label>
      <input type="date" name="tarih" required id="gorusme-tarihi">
      <div id="uyari">*Sadece 4 gün geriye dönük giriş yapılabilir!</div>

      <label>Başlama Saati:</label>
      <input type="time" name="baslamasaati" id="baslamasaati" required>

      <label>Bitiş Saati:</label>
      <input type="time" name="bitissaati" id="bitissaati" required>

      <div id="saat-uyari"></div><br>

      <label>Yapıldığı Yer:</label>
      <input type="text" name="yapilanyer" required autocomplete="off">

      <label>Oturum Sayısı:</label>
      <input type="number" name="oturumsayisi" autocomplete="off">

      <label>Çalışma Yöntemi:</label><br>
      <bold><input type="radio" name="calismayontemi" value="Yüz Yüze" required>Yüz Yüze</bold>
      <bold><input type="radio" name="calismayontemi" value="Uzaktan" required>Uzaktan</bold>

      <label>Öğrenci Davranış Değişikliği:</label>
      <select name="ogr_davranis">
        <option value="Kurula Sevk">Kurula Sevk</option>
        <option value="Şahitlik">Şahitlik</option>
      </select>

      <label><input type="checkbox" name="akrangorusmesi" value="1"> Akran Görüşmesi</label>

      <label>Açıklama:</label>
      <textarea name="aciklama" rows="4" cols="40" autocomplete="off"></textarea>

      <label>Dönem:</label>
      <input type="text" name="donem" required> <br><br>

      <div class="button-group">
        <button type="submit">Ekle</button>
        <button type="reset">Temizle</button>
        <button type="button" onclick="window.location.href='listele.php'">Listele</button>
      </div>
    </form>
  </div>
</div>

<script src="../script/asamalar.js"></script>
<script src="../script/form.js"></script>

<script>
  // global veri dizisi
  window.veri = [];

  document.getElementById('ara').addEventListener('click', function(e){
    e.preventDefault();
    const form = document.getElementById('arama-form');
    const data = new FormData(form);

    fetch('form.php?ajax=1',{ method:'POST', body:data })
    .then(res => res.json())
    .then(obj => {
      const { bireysel, grup } = obj;

      // 1) window.veri'ye tüm kayıtları ekle (bireysel_grup tipi ile birlikte)
      window.veri = [
        ...bireysel.map(r => ({ ...r, bireysel_grup: 'bireysel' })),
        ...grup.map(r => ({ ...r, bireysel_grup: 'grup' }))
      ];

      // 2) DOM referansları
      const sonucDiv = document.getElementById('arama-sonuclari');
      const grupDiv  = document.getElementById('grup-sonuclari');

      // filtre değerleri
      const fIsim   = document.getElementById('isim_soyisim').value.trim().toLowerCase();
      const fSinif  = document.getElementById('sinif').value.trim().toLowerCase();
      const fOkulno = document.getElementById('okulno').value.trim();
      const reNo    = fOkulno ? new RegExp(`\\b${fOkulno}\\b`) : null;

      // filtreli veriler
      const bireyselFiltreli = bireysel.filter(r =>
        (!fIsim || r.isim_soyisim.toLowerCase().includes(fIsim)) &&
        (!fSinif || r.sinif.toLowerCase().includes(fSinif)) &&
        (!fOkulno || reNo.test(String(r.okulno)))
      );

      const grupFiltreli = grup.filter(g =>
        (!fIsim || g.ogrencilerin_bilgileri.toLowerCase().includes(fIsim)) &&
        (!fSinif || g.ogrencilerin_bilgileri.toLowerCase().includes(fSinif)) &&
        (!fOkulno || reNo.test(g.ogrencilerin_bilgileri))
      );

      // bireysel sonuçlar
      let html1 = '<h3>Bireysel Görüşmeler</h3>';
      if (bireyselFiltreli.length) {
        html1 += '<table><tr>'
              + '<th>İsim Soyisim</th><th>Sınıf</th><th>Okul No</th>'
              + '<th>RDP Hizmet</th><th>1. Aşama</th><th>2. Aşama</th><th>3. Aşama</th>'
              + '<th>Tarih</th><th>Başlama</th><th>Bitiş</th><th>Açıklama</th>'
              + '</tr>';
        bireyselFiltreli.forEach(r => {
          html1 += `<tr>
            <td>${r.isim_soyisim}</td><td>${r.sinif}</td><td>${r.okulno}</td>
            <td>${r.rdp_hizmet || '-'}</td><td>${r.birinciasama || '-'}</td>
            <td>${r.ikinciasama || '-'}</td><td>${r.ucuncuasama || '-'}</td>
            <td>${r.tarih}</td><td>${r.baslamasaati}</td><td>${r.bitissaati}</td>
            <td>${r.aciklama.replace(/\n/g, '<br>')}</td>
          </tr>`;
        });
        html1 += '</table>';
      } else html1 += '<p>Hiç bireysel görüşme yok.</p>';
      sonucDiv.innerHTML = html1;
      sonucDiv.classList.add('show');

      // grup sonuçları
      let html2 = '<h3>Grup Görüşmeleri</h3>';
      if (grupFiltreli.length) {
        html2 += '<table><tr>'
              + '<th>Öğrenci Bilgileri</th><th>RDP Hizmet</th>'
              + '<th>1. Aşama</th><th>2. Aşama</th><th>3. Aşama</th>'
              + '<th>Tarih</th><th>Başlama</th><th>Bitiş</th><th>Açıklama</th>'
              + '</tr>';
        grupFiltreli.forEach(g => {
          html2 += `<tr>
            <td>${g.ogrencilerin_bilgileri.replace(/\n/g, '<br>')}</td>
            <td>${g.rdp_hizmet || '-'}</td><td>${g.birinciasama || '-'}</td>
            <td>${g.ikinciasama || '-'}</td><td>${g.ucuncuasama || '-'}</td>
            <td>${g.tarih}</td><td>${g.baslamasaati}</td>
            <td>${g.bitissaati}</td><td>${g.aciklama.replace(/\n/g, '<br>')}</td>
          </tr>`;
        });
        html2 += '</table>';
      } else html2 += '<p>Hiç grup görüşmesi yok.</p>';
          grupDiv.innerHTML = html2;
          grupDiv.classList.add('show');

      // ilk bireysel varsa formu otomatik doldur
      if (bireyselFiltreli.length) {
        document.getElementById('form_isim_soyisim').value = bireyselFiltreli[0].isim_soyisim;
        document.getElementById('form_sinif').value         = bireyselFiltreli[0].sinif;
        document.getElementById('form_okulno').value        = bireyselFiltreli[0].okulno;
      }

       document.getElementById('form').classList.add('show');
    })
    .catch(console.error);
  });

  // toggleForm fonksiyonu
  function toggleForm() {
    const bireyselGrup = document.querySelectorAll('input[name="bireysel_grup"]');
    const textareaContainer = document.getElementById('textarea-container');
    const isimSoyisimLabel = document.querySelector('label[for="form_isim_soyisim"]');
    const sinifLabel      = document.querySelector('label[for="form_sinif"]');
    const okulnoLabel     = document.querySelector('label[for="form_okulno"]');
    const isimSoyisim     = document.getElementById('form_isim_soyisim');
    const sinif           = document.getElementById('form_sinif');
    const okulno          = document.getElementById('form_okulno');
    const grupSonuclarDiv = document.getElementById('form-grup-sonuclari');

    if (bireyselGrup[0].checked) {
      // bireysel seçili
      isimSoyisimLabel.style.display = sinifLabel.style.display = okulnoLabel.style.display =
      isimSoyisim.style.display = sinif.style.display = okulno.style.display = 'inline';
      textareaContainer.style.display = 'none';
    } else {
      // grup seçili
      isimSoyisimLabel.style.display = sinifLabel.style.display = okulnoLabel.style.display =
      isimSoyisim.style.display = sinif.style.display = okulno.style.display = 'none';
      textareaContainer.style.display = 'inline';

      // grup sonuçlarını getir
      const grupSonuclar = window.veri.filter(item => item.bireysel_grup === 'grup');
      grupSonuclarDiv.innerHTML = '';
      if (grupSonuclar.length) {
        grupSonuclar.forEach(item => {
          const div = document.createElement('div');
          div.classList.add('sonuc-karti');
          div.innerHTML = `
            <strong>Öğrenci Bilgileri:</strong> ${item.ogrencilerin_bilgileri || '-'}<br>
            <strong>RDP Hizmet:</strong> ${item.rdp_hizmet || '-'}<br>
            <strong>1. Aşama:</strong> ${item.birinciasama || '-'}<br>
            <strong>2. Aşama:</strong> ${item.ikinciasama || '-'}<br>
            <strong>3. Aşama:</strong> ${item.ucuncuasama || '-'}<br>
            <strong>Tarih:</strong> ${item.tarih || '-'}<br>
            <strong>Başlama:</strong> ${item.baslamasaati || '-'}<br>
            <strong>Bitiş:</strong> ${item.bitissaati || '-'}<br>
            <strong>Yer:</strong> ${item.yapilanyer || '-'}<br>
            <strong>Oturum Sayısı:</strong> ${item.oturumsayisi || '-'}<br>
            <strong>Çalışma Yöntemi:</strong> ${item.calismayontemi || '-'}<br>
            <strong>Dönem:</strong> ${item.donem || '-'}<br>
            <strong>Açıklama:</strong> ${item.aciklama || '-'}
          `;
          grupSonuclarDiv.appendChild(div);
        });
      } else {
        grupSonuclarDiv.innerHTML = '<p>Grup görüşmesi bulunamadı.</p>';
      }
    }
  }

  // global olarak erişilebilir yap
  window.toggleForm = toggleForm;
</script>


</body>
</html>