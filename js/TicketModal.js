document.addEventListener("DOMContentLoaded", function() {
    const ticketLink = document.getElementById("ticketLink");
    const ticketModal = document.getElementById("ticketModal");
    const closeButton = ticketModal.querySelector(".close-button");

    // Open modal when ticket link is clicked
    ticketLink.onclick = function(event) {
        event.preventDefault();
        ticketModal.style.display = "flex"; // Show modal with flex
        setTimeout(() => ticketModal.classList.add("show"), 10); // Add transition class with a slight delay
    };

    // Close modal when close button is clicked
    closeButton.onclick = function() {
        ticketModal.classList.remove("show"); // Start transition to hide modal
        setTimeout(() => {
            ticketModal.style.display = "none"; // Fully hide modal after transition
        }, 300); // Match this duration to CSS transition time (0.3s)
    };

    // Close modal when clicking outside the modal content
    window.onclick = function(event) {
        if (event.target === ticketModal) {
            ticketModal.classList.remove("show");
            setTimeout(() => {
                ticketModal.style.display = "none";
            }, 300);
        }
    };
});
