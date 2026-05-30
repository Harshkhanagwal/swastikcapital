document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll('form[action*="forminit.com/f/"]');

    forms.forEach(function (form) {
        form.addEventListener("submit", function () {
            if (!form.checkValidity()) {
                return;
            }

            const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');

            form.classList.add("form-is-submitting");
            form.setAttribute("aria-busy", "true");

            if (submitButton) {
                submitButton.dataset.originalText = submitButton.textContent;
                submitButton.disabled = true;
                submitButton.textContent = "Sending...";
            }
        });
    });
});
