document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popup-home");

    // Variabel waktu delay dalam detik
    const popupDelayInSeconds = 10; // Ganti angka 5 dengan detik yang kamu inginkan

    // Fungsi untuk menampilkan popup setelah delay
    setTimeout(function () {
        popup.classList.remove("hidden");
    }, popupDelayInSeconds * 1000); // dikalikan 1000 untuk mengubah detik ke milidetik

    // Fungsi global untuk menutup popup
    window.closePopup = function () {
        popup.classList.add("hidden");
    };

    // Event listener agar popup bisa ditutup dengan klik di luar konten
    popup.addEventListener("click", function (event) {
        if (event.target === popup) {
            closePopup();
        }
    });
});

