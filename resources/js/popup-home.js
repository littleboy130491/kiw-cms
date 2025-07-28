// Home Page Popup Management
const popups = document.querySelectorAll('#popup-home, .popup-home, [data-home-popup]');

if (popups.length > 0) {
    popups.forEach(popup => {
        // Variabel waktu delay dalam detik
        const popupDelayInSeconds = 10; // Ganti angka dengan detik yang diinginkan
        const delayTime = popup.getAttribute('data-delay') || popupDelayInSeconds;

        // Fungsi untuk menampilkan popup setelah delay
        setTimeout(function () {
            popup.classList.remove("hidden");
        }, delayTime * 1000); // dikalikan 1000 untuk mengubah detik ke milidetik

        // Event listener agar popup bisa ditutup dengan klik di luar konten
        popup.addEventListener("click", function (event) {
            if (event.target === popup) {
                if (typeof window.closePopup === 'function') {
                    window.closePopup();
                } else {
                    popup.classList.add("hidden");
                }
            }
        });
    });
    
    // Fungsi global untuk menutup popup (compatibility)
    window.closePopup = function () {
        popups.forEach(popup => {
            popup.classList.add("hidden");
        });
    };
}

