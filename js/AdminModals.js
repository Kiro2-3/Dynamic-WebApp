function openViewModal(ticket) {
    const modal = document.getElementById('viewModal');
    modal.classList.add('show'); // Add 'show' class to trigger the transition

    // Populate modal content
    document.getElementById('viewEmail').textContent = ticket.Email || 'N/A';
    document.getElementById('viewInstitute').textContent = ticket.institute || 'N/A';
    document.getElementById('viewConcern').textContent = ticket.concern || 'N/A';
    document.getElementById('viewStatus').textContent = ticket.status || 'N/A';
    if (ticket.file) {
        document.getElementById('viewAttachment').href = ticket.file;
        document.getElementById('viewAttachment').textContent = 'Download';
    } else {
        document.getElementById('viewAttachment').textContent = 'No Attachment';
        document.getElementById('viewAttachment').removeAttribute('href');
    }
}

function closeViewModal() {
    const modal = document.getElementById('viewModal');
    modal.classList.remove('show'); 
}

function openEmailModal(email) {
    const modal = document.getElementById('emailModal');
    modal.classList.add('show'); 
    document.getElementById('emailRecipient').value = email;
}

function closeEmailModal() {
    const modal = document.getElementById('emailModal');
    modal.classList.remove('show'); 
}
