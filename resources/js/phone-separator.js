const phoneLinks = document.querySelectorAll('.phone, input[type="tel"], .phone-input');

if (phoneLinks.length > 0) {
    phoneLinks.forEach(link => {
        let rawNumber = link.textContent.trim();

        // Hilangkan semua karakter selain + dan angka
        let cleaned = rawNumber.replace(/[^\d+]/g, '');

        if (cleaned.startsWith('+62')) {
            let prefix = '+62';
            let rest = cleaned.slice(3);

            // Bagi menjadi blok-blok 4 digit
            let grouped = rest.match(/.{1,4}/g).join(' ');

            // Gabungkan kembali
            let formatted = prefix + ' ' + grouped;

            link.textContent = link.textContent.replace(cleaned, formatted);
        }
    });
    
    console.log(`Phone: Formatted ${phoneLinks.length} phone numbers`);
} else {
    console.log('Phone: No phone elements found');
}