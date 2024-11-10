<link rel="stylesheet" href="/public/styles/sideBar.css">
<div class="sidebar__container">
        <img src="/public/image/cdmLogo.png" alt="Logo">
        <h2><span style="color: #FEAE00;">CDM</span>CSS <br><span style="font-size: medium;">Admin Dashboard</span></h2>
        <ul style="list-style-type: none;">
            <li><a href="../views/Admin/statistics.php" onclick="loadPage(event, 'statistics')">Statistics</a></li>
            <li><a href="../views/Admin/chatsupport.php" onclick="loadPage(event, 'chatsupport')">Chat Support</a></li>
            <li><a href="../views/Admin/issues.php" onclick="loadPage(event, 'issues')">Issues</a></li>
            <li><a href="../views/Admin/tickets.php" onclick="loadPage(event, 'tickets')">Tickets</a></li>
            <li><a href="../views/Admin/credentials.php" onclick="loadPage(event, 'credentials')">Credentials</a></li>
        </ul>
        <button class="logout__btn">
            <i class="fa fa-sign-out-alt"></i> Logout
        </button>
    </div>
    <div id="content" class="content">
        <h1>Statistics</h1>
    </div>

    <script>
       function loadPage(event, page) {
    event.preventDefault(); // Prevent the default link behavior

    // Define the URL based on the page name
    const url = `../views/Admin/${page}.php`;

    // Update the browser's URL without reloading
    history.pushState(null, '', `/${page}`);

    // Fetch the content and update the #content div
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Error loading page:', error));
}

    </script>