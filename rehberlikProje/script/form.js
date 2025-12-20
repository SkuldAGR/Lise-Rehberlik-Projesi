document.addEventListener('DOMContentLoaded', function () {
    const tarihInput = document.getElementById('gorusme-tarihi');
    const uyari = document.getElementById('uyari');
    const baslamaSaati = document.getElementById('baslamasaati');
    const bitisSaati = document.getElementById('bitissaati');
    const saatUyari = document.getElementById('saat-uyari');
    const formElement = document.querySelector('#form form');

    // Min ve max tarih ayarlama
    function setDateLimits() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const maxDate = `${yyyy}-${mm}-${dd}`;

        const pastDate = new Date();
        pastDate.setDate(today.getDate() - 4);
        const pyyyy = pastDate.getFullYear();
        const pmm = String(pastDate.getMonth() + 1).padStart(2, '0');
        const pdd = String(pastDate.getDate()).padStart(2, '0');
        const minDate = `${pyyyy}-${pmm}-${pdd}`;

        tarihInput.setAttribute('min', minDate);
        tarihInput.setAttribute('max', maxDate);
    }

    // Tarih değişim kontrolü
    tarihInput.addEventListener('change', () => {
        const selected = new Date(tarihInput.value);
        const today = new Date();
        const fourDaysAgo = new Date();
        fourDaysAgo.setDate(today.getDate() - 4);

        selected.setHours(0, 0, 0, 0);
        today.setHours(0, 0, 0, 0);
        fourDaysAgo.setHours(0, 0, 0, 0);

        if (selected < fourDaysAgo || selected > today) {
            uyari.textContent = "Bugün dahil en fazla 4 gün geriye dönük giriş yapabilirsiniz.";
            tarihInput.value = '';
        } else {
            uyari.style.display = 'none';
        }
    });

    // Başlama ve bitiş saati kontrolü
    function saatKontrol() {
        const baslama = baslamaSaati.value;
        const bitis = bitisSaati.value;

        if (baslama && bitis && bitis <= baslama) {
            saatUyari.textContent = "Bitiş saati, başlama saatinden sonra olmalı.";
            saatUyari.classList.add('show');
        } else {
            saatUyari.classList.remove('show');
            setTimeout(() => {
                if (!saatUyari.classList.contains('show')) {
                    saatUyari.textContent = '';
                }
            }, 400);
        }
    }

    baslamaSaati.addEventListener('change', saatKontrol);
    bitisSaati.addEventListener('change', saatKontrol);

    // Form gönderilmeden önce kontrol
    formElement.addEventListener('submit', function (e) {
        const baslama = baslamaSaati.value;
        const bitis = bitisSaati.value;

        if (baslama && bitis && bitis <= baslama) {
            e.preventDefault(); // Formu durdur
            saatUyari.textContent = "Bitiş saati, başlama saatinden sonra olmalı.";
            saatUyari.style.color = 'red';
            saatUyari.classList.add('show');
        }
    });

    // Ara butonuna basınca form ve sonuçları göster
    document.getElementById('ara').addEventListener('click', function (event) {
        event.preventDefault();

        const okulNo = document.querySelector('input[name="okulno"]').value.trim();
        const isimSoyisim = document.querySelector('input[name="isim_soyisim"]').value.trim();
        const sinif = document.querySelector('input[name="sinif"]').value.trim();

        if (okulNo || isimSoyisim || sinif) {
            document.getElementById('form').classList.add('show');
            document.getElementById('arama-sonuclari').classList.add('show');
        } else {
            alert('Lütfen en az bir alanı doldurun.');
        }
    });

    setDateLimits();
});

        function kopyala() {
            var txt1 = document.getElementById("isim_soyisim").value;
            var txt2 = document.getElementById("sinif").value;
            var txt3 = document.getElementById("okulno").value;

            // Alttaki textboxtlara kopyalama işlemi
            document.getElementById("form_isim_soyisim").value = txt1;
            document.getElementById("form_sinif").value = txt2;
            document.getElementById("form_okulno").value = txt3;
        }

    function toggleForm() {
      const bireyselGrup = document.querySelectorAll('input[name="bireysel_grup"]');
      const isimSoyisimLabel = document.querySelector('label[for="form_isim_soyisim"]');
      const sinifLabel = document.querySelector('label[for="form_sinif"]');
      const okulnoLabel = document.querySelector('label[for="form_okulno"]');
      const isimSoyisim = document.getElementById('form_isim_soyisim');
      const sinif = document.getElementById('form_sinif');
      const okulno = document.getElementById('form_okulno');
      const textareaContainer = document.getElementById('textarea-container');


    // Grup görüşmeleri için ek alan
        const grupSonuclarDiv = document.getElementById('grup-sonuclari');
        grupSonuclarDiv.innerHTML = ''; // Önceki sonuçları temizle

        const grupSonuclar = veri.filter(item => item.bireysel_grup === "grup");

        if (grupSonuclar.length > 0) {
            grupSonuclar.forEach(item => {
                const div = document.createElement('div');
                div.classList.add('sonuc-karti');

                div.innerHTML = `
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
                    <strong>Öğrenci Bilgileri:</strong> ${item.ogrencilerin_bilgileri || '-'}<br>
                    <strong>Dönem:</strong> ${item.donem || '-'}<br>
                    <strong>Açıklama:</strong> ${item.aciklama || '-'}
                `;
                grupSonuclarDiv.appendChild(div);
            });
        } else {
            grupSonuclarDiv.innerHTML = '<p>Grup görüşmesi bulunamadı.</p>';
        }

      // Eğer Bireysel seçildiyse, formu eski haline getir
      if (bireyselGrup[0].checked) {
        isimSoyisimLabel.style.display = 'inline';
        sinifLabel.style.display = 'inline';
        okulnoLabel.style.display = 'inline';
        isimSoyisim.style.display = 'inline';
        sinif.style.display = 'inline';
        okulno.style.display = 'inline';
        textareaContainer.style.display = 'none';
      }
      // Eğer Grup seçildiyse, eski alanları gizle, textarea ekle ve inputları temizle
      else if (bireyselGrup[1].checked) {
        isimSoyisimLabel.style.display = 'none';
        sinifLabel.style.display = 'none';
        okulnoLabel.style.display = 'none';
        isimSoyisim.style.display = 'none';
        sinif.style.display = 'none';
        okulno.style.display = 'none';
        textareaContainer.style.display = 'inline';
        
        // Inputları temizle
        isimSoyisim.value = '';
        sinif.value = '';
        okulno.value = '';
      }
    }