// Phone number formatting utility
export function initPhoneFormatting() {
    document.addEventListener('DOMContentLoaded', function () {
        const phoneLinks = document.querySelectorAll('.phone');

        phoneLinks.forEach(link => {
            let rawNumber = link.textContent.trim();

            // Remove all characters except + and numbers
            let cleaned = rawNumber.replace(/[^\d+]/g, '');

            if (cleaned.startsWith('+62')) {
                let prefix = '+62';
                let rest = cleaned.slice(3);

                // Split into 4-digit blocks
                let grouped = rest.match(/.{1,4}/g).join(' ');

                // Combine back
                let formatted = prefix + ' ' + grouped;

                link.textContent = link.textContent.replace(cleaned, formatted);
            }
        });
    });
}

// Auto-initialize
initPhoneFormatting();