function openEmailModal() {
    const emailModal = document.getElementById('emailModal');
    const modalContent = emailModal.querySelector('.modal-content');

    emailModal.style.display = 'flex'; 
    setTimeout(() => {
        emailModal.classList.add('show');
        modalContent.classList.add('show');
    }, 10); 
}

function closeEmailModal() {
    const emailModal = document.getElementById('emailModal');
    const modalContent = emailModal.querySelector('.modal-content');

    emailModal.classList.remove('show');
    modalContent.classList.remove('show');
    setTimeout(() => {
        emailModal.style.display = 'none'; 
    }, 300); 
}

function openViewModal() {
    const viewModal = document.getElementById('viewModal');
    const modalContent = viewModal.querySelector('.modal-content');

    viewModal.style.display = 'flex'; 
    setTimeout(() => {
        viewModal.classList.add('show');
        modalContent.classList.add('show');
    }, 10); 
}

function closeViewModal() {
    const viewModal = document.getElementById('viewModal');
    const modalContent = viewModal.querySelector('.modal-content');

    viewModal.classList.remove('show');
    modalContent.classList.remove('show');
    setTimeout(() => {
        viewModal.style.display = 'none'; 
    }, 300); 
}
