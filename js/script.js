document.addEventListener("DOMContentLoaded", function () {
    console.log("Cosmic Museum scripts loaded.");

    // Form Validation
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            let isValid = true;
            const inputs = form.querySelectorAll("input[required], textarea[required], select[required]");

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = "#ff6b6b";
                } else {
                    input.style.borderColor = "#444";
                }
            });

            // Password confirmation check
            const password = form.querySelector("input[name='password']");
            const confirmPassword = form.querySelector("input[name='confirm_password']");

            if (password && confirmPassword) {
                if (password.value !== confirmPassword.value) {
                    isValid = false;
                    alert("Passwords do not match!");
                }
            }

            if (!isValid) {
                e.preventDefault();
                alert("Please fill in all required fields.");
            }
        });
    });

    // Rollover effect for images (simple opacity change on hover is handled by CSS, 
    // but let's add a JS-based dynamic class toggle for demonstration)
    const images = document.querySelectorAll("img");
    images.forEach(img => {
        img.addEventListener("mouseenter", () => {
            img.style.transition = "transform 0.5s ease";
            img.style.transform = "scale(1.02)";
        });
        img.addEventListener("mouseleave", () => {
            img.style.transform = "scale(1)";
        });
    });
});
