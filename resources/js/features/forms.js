// Form utilities and interactions
export class FormManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupSelectBoxes();
    }

    setupSelectBoxes() {
        // Update input when a year is selected from dropdown
        window.updateInput = () => {
            const selectElement = document.getElementById("yearSelect");
            const inputField = document.getElementById("search-penghargaan");
            
            if (selectElement && inputField) {
                inputField.value = selectElement.value;
            }
        };

        // Update select dropdown if input value matches a year
        window.updateSelect = () => {
            const inputField = document.getElementById("search-penghargaan");
            const selectElement = document.getElementById("yearSelect");
            
            if (inputField && selectElement) {
                // Check if input is a valid year and update select
                if (inputField.value.match(/^\d{4}$/)) {
                    selectElement.value = inputField.value;
                }
            }
        };

        // Handle search action
        window.handleSearch = () => {
            const searchInput = document.getElementById("search-penghargaan");
            if (searchInput) {
                alert("Anda mencari tahun: " + searchInput.value);
            }
        };
    }
}

// Auto-initialize when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
    new FormManager();
});