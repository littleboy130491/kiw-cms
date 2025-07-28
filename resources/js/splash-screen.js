// Check if splash screen elements exist
const splashScreen = document.getElementById("splash-screen");
const logoSequence = document.getElementById("logo-sequence");

console.log('Splash Screen Debug:', {
  splashScreen: !!splashScreen,
  logoSequence: !!logoSequence,
  readyState: document.readyState
});

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

  console.log(`Splash Screen: Found ${logos.length} logo sequences`);

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
    console.log('showNextLogo called:', {
      logoImage: !!logoImage,
      yearText: !!yearText,
      logosLength: logos.length,
      index: index
    });
    
    // If no logos or elements, complete immediately
    if (!logoImage || !yearText || logos.length === 0) {
      console.log('No logos or elements, completing splash screen in 2 seconds');
      setTimeout(completeSplashScreen, 2000); // Show splash for 2 seconds then complete
      return;
    }

    if (index < logos.length) {
      // Fade out logo
      logoImage.style.opacity = 0;

      setTimeout(() => {
        // Ganti gambar logo dan tahun
        logoImage.src = logos[index].src;
        yearText.textContent = logos[index].year;

        // Fade in logo
        logoImage.style.opacity = 1;

        // Lanjutkan ke logo berikutnya setelah jeda
        index++;
        setTimeout(showNextLogo, 500); // jeda antar logo
      }, 500); // waktu untuk fade out
    } else {
      completeSplashScreen();
    }
  }

  // Start animation immediately since module loader ensures DOM is ready
  document.body.classList.add("no-scroll"); // Kunci scroll sebelum animasi
  
  // Start immediately, but also listen for window load as fallback
  if (document.readyState === 'complete') {
    showNextLogo();
  } else {
    window.addEventListener("load", () => {
      showNextLogo();
    });
    // Also start after a short delay as fallback
    setTimeout(() => {
      showNextLogo();
    }, 100);
  }

} else {
  console.log('Splash Screen: No splash screen elements found');
}