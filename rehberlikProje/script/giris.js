function giris(event) {
    // Formun varsayılan gönderimini engelle
    event.preventDefault();  // Bu, formun otomatik olarak gönderilmesini engeller

    const isim = document.getElementById("isim").value;
    const sifre = document.getElementById("sifre").value;

    if (isim === "admin" && sifre === "admin123") {
        alert("Giriş başarılı!");
        window.location.href = "../html/main.html";  // Başarılı giriş sonrası yönlendirme
    } else {
        alert("Giriş Başarısız!");
        window.location.href = "../html/giris.html";  // Başarısız giriş sonrası tekrar giriş sayfasına yönlendirme
    }
}
