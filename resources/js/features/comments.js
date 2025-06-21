// Comment system functionality
export class CommentManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupReplyForms();
        this.setupReplyNames();
    }

    setupReplyForms() {
        const replyButtons = document.querySelectorAll('.reply-button');
        const replyFormTemplate = document.getElementById("reply-form-template");

        if (!replyFormTemplate || replyButtons.length === 0) return;

        replyButtons.forEach(button => {
            button.addEventListener("click", (e) => {
                e.preventDefault();

                // Remove any existing cloned reply form
                document.querySelectorAll(".reply-form").forEach(form => {
                    if (form.dataset.clone === "true") {
                        form.remove();
                    }
                });

                // Clone the reply form
                const clonedForm = replyFormTemplate.cloneNode(true);
                clonedForm.classList.remove("hidden");
                clonedForm.removeAttribute("id");
                clonedForm.dataset.clone = "true";

                // Append form under the clicked comment
                const parentArticle = button.closest("article");
                if (parentArticle) {
                    parentArticle.appendChild(clonedForm);
                }
            });
        });
    }

    setupReplyNames() {
        const fromNameSpans = document.querySelectorAll('.from-name');

        fromNameSpans.forEach(span => {
            // Find reply <li>
            const currentLi = span.closest('li');

            if (!currentLi) return;

            // Find <ol> that wraps currentLi
            const currentOl = currentLi.parentElement;

            // Find parent comment <li> from this <ol>
            const parentLi = currentOl.closest('li');

            if (!parentLi) return;

            // Get name from <h5> inside parent comment
            const parentNameH5 = parentLi.querySelector('> article h5.name');

            if (parentNameH5) {
                span.textContent = parentNameH5.textContent.trim();
            }
        });
    }
}

// Auto-initialize when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
    new CommentManager();
});