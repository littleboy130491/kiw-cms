// Splash screen with logo sequence animation
export function initSplashScreen() {
    // Get all logo elements from hidden HTML
    const logoElements = document.querySelectorAll("#logo-sequence .logo-item");
    const logos = [];

    // Insert logo data and year into array
    logoElements.forEach(img => {
        logos.push({
            year: img.getAttribute("data-year"),
            src: img.getAttribute("src")
        });
    });

    if (logos.length === 0) return;

    let index = 0;
    const logoImage = document.getElementById("logo-image");
    const yearText = document.getElementById("year-text");

    function showNextLogo() {
        if (index < logos.length) {
            // Fade out logo
            if (logoImage) logoImage.style.opacity = 0;

            setTimeout(() => {
                // Change logo image and year
                if (logoImage) logoImage.src = logos[index].src;
                if (yearText) yearText.textContent = logos[index].year;

                // Fade in logo
                if (logoImage) logoImage.style.opacity = 1;

                // Continue to next logo after delay
                index++;
                setTimeout(showNextLogo, 500); // delay between logos
            }, 500); // time for fade out
        } else {
            // All logos finished displaying
            const splash = document.getElementById("splash-screen");
            const content = document.getElementById("main-content");

            if (splash) {
                splash.style.opacity = 0;

                setTimeout(() => {
                    splash.style.display = "none";
                    document.body.classList.remove("no-scroll"); // Enable scroll
                    
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
    }

    // Start animation when window finishes loading
    window.addEventListener("load", () => {
        document.body.classList.add("no-scroll"); // Lock scroll before animation
        showNextLogo();
    });
}

// Auto-initialize
initSplashScreen();