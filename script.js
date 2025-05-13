// Confirm before deleting an item
function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
}

// Toggle password visibility
function togglePassword() {
    const pwField = document.getElementById("password");
    if (pwField.type === "password") {
        pwField.type = "text";
    } else {
        pwField.type = "password";
    }
}

// Highlight expiry date status
function highlightExpiryDates() {
    const expiryElements = document.querySelectorAll(".expiry-date");

    expiryElements.forEach(elem => {
        const expiryText = elem.dataset.expiry;
        if (!expiryText) return;

        const expiryDate = new Date(expiryText);
        const today = new Date();
        const diffDays = Math.floor((expiryDate - today) / (1000 * 60 * 60 * 24));

        if (diffDays < 0) {
            elem.style.color = "red";
            elem.innerHTML += " (Expired)";
        } else if (diffDays <= 7) {
            elem.style.color = "orange";
            elem.innerHTML += " (Expiring Soon)";
        } else {
            elem.style.color = "green";
        }
    });
}

// Set minimum expiry date to today
function setMinExpiryDate() {
    const expiryInput = document.querySelector('input[type="date"]');
    if (expiryInput) {
        const today = new Date().toISOString().split("T")[0];
        expiryInput.setAttribute("min", today);
    }
}

// Initialize expiry-related features after DOM loads
document.addEventListener("DOMContentLoaded", () => {
    highlightExpiryDates();
    setMinExpiryDate();
});
