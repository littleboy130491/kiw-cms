// Check if splash screen elements exist
const splashScreen = document.getElementById("splash-screen");
const logoSequence = document.getElementById("logo-sequence");

if (splashScreen && logoSequence) {
  // Ambil semua elemen logo dari HTML tersembunyi
  const logoElements = logoSequence.querySelectorAll(".logo-item");
  const logos = [];

  // Masukkan data logo dan tahun ke dalam array
  logoElements.forEach(img => {
    logos.push({
      year: img.getAttribute("data-year"),
      src: img.getAttribute("src")
    });
  });

  let index = 0;
  const logoImage = document.getElementById("logo-image");
  const yearText = document.getElementById("year-text");

  function completeSplashScreen() {
    // Semua logo selesai ditampilkan atau tidak ada logo
    const splash = document.getElementById("splash-screen");
    const content = document.getElementById("main-content");

    if (splash) {
      splash.style.opacity = 0;

      setTimeout(() => {
        splash.style.display = "none";
        document.body.classList.remove("no-scroll"); // Aktifkan scroll
        
        if (content) {
          content.style.display = "block";

          setTimeout(() => {
            content.style.opacity = 1;
            content.style.transform = "translateY(0)";
          }, 50);
        }
      }, 1000);
    }
  }

  function showNextLogo() {
    // If no logos or elements, complete immediately
    if (!logoImage || !yearText || logos.length === 0) {
      setTimeout(completeSplashScreen, 2000); //
      return;
    }

    if (index < logos.length) {
      // Add smooth transition
      logoImage.style.transition = 'opacity 0.3s ease-in-out';
      yearText.style.transition = 'opacity 0.3s ease-in-out';
      
      // Fade out logo
      logoImage.style.opacity = 0;
      yearText.style.opacity = 0;

      setTimeout(() => {
        // Ganti gambar logo dan tahun
        logoImage.src = logos[index].src;
        yearText.textContent = logos[index].year;

        // Fade in logo
        logoImage.style.opacity = 1;
        yearText.style.opacity = 1;

        // Lanjutkan ke logo berikutnya setelah jeda
        index++;
        setTimeout(showNextLogo, 500); // transition timing
      }, 200); //  fade out timing
    } else {
      completeSplashScreen();
    }
  }

  // Start animation immediately since module loader ensures DOM is ready
  document.body.classList.add("no-scroll");
  
  // Start immediately with proper timing
  requestAnimationFrame(() => {
    setTimeout(showNextLogo, 200); // Small delay to ensure smooth start
  });

} else {
  // No splash screen elements found, don't block the page
}