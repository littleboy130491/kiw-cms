
// WhatsApp Message Generator
const headings = document.querySelectorAll('#bangunan-pabrik h2.get-message, .get-message, [data-whatsapp-heading]');
const links = document.querySelectorAll('#bangunan-pabrik a.wa-message, .wa-message, [data-whatsapp-link]');

if (headings.length > 0 && links.length > 0) {
    headings.forEach((heading, index) => {
        const correspondingLink = links[index] || links[0]; // Use first link if no corresponding index
        
        if (heading && correspondingLink) {
            const headingText = heading.textContent.trim();
            const message = `Halo PT Kawasan Industri Wijayakusuma, saya ingin informasi mengenai ${headingText}`;
            const encodedMessage = encodeURIComponent(message);
            const phoneNumber = window.waNumber ?? "6281211118022";
            correspondingLink.href = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodedMessage}`;
        }
    });
}

