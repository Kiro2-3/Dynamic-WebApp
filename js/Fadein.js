document.addEventListener("DOMContentLoaded", function() {
    const valuesContainers = document.querySelectorAll(".values__container");

    // Function to check if element is in viewport
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.bottom >= 0
        );
    }

    // Function to toggle fade-in and fade-out effects based on scroll
    function toggleFadeEffect() {
        valuesContainers.forEach(container => {
            if (isInViewport(container)) {
                container.classList.add("fade-in");
                container.classList.remove("fade-out");
            } else {
                container.classList.remove("fade-in");
                container.classList.add("fade-out");
            }
        });
    }

    // Initial check on load and on scroll
    toggleFadeEffect();
    window.addEventListener("scroll", toggleFadeEffect);
});