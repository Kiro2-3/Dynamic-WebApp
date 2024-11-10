document.querySelector('.profile__icon').addEventListener('click', function() {
        const modal = document.querySelector('.profile__modal');
        modal.style.display = modal.style.display === 'none' || !modal.style.display ? 'block' : 'none';
    });

    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        const modal = document.querySelector('.profile__modal');
        if (!modal.contains(event.target) && !document.querySelector('.profile__icon').contains(event.target)) {
            modal.style.display = 'none';
        }
    });

