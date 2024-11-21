
 function filterTable() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.credentials-table tbody tr');
    
    rows.forEach(row => {
        const username = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

        if (username.includes(searchInput) || email.includes(searchInput)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}