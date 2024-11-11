<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles/Home.css">
    <title>Document</title>
</head>
<body>
    <?php require('../components/Topbar.php') ?>

    <h2 class="centered-text">
        Our customer support team is 
        <span class="highlight">dedicated</span> to 
        <span class="highlight">helping</span> students, parents, and faculty with any 
        <span class="highlight">inquiries</span>, providing timely 
        <span class="highlight">assistance</span> and resources to ensure a 
        <span class="highlight">positive</span> school experience for everyone.
    </h2>

    <div class="main__container">
        <div class="content__container">
            <h1 style="text-align: center;">Our Core <span style="color: #FEAE00;">Values</span></h1>

            <div class="corevalues__boxes">
                <div class="values__container hidden">
                    <h3>EXCELLENCE</h3>
                    <p>Colegio De Montalban is committed to nurturing excellent professionals.</p>
                </div>

                <div class="values__container hidden">
                    <h3>RESPECT</h3>
                    <p>Colegio De Montalban is committed to cultivating a community
                        with high regard for others, society, and the environment.
                    </p>
                </div>

                <div class="values__container hidden">
                    <h3>ACCOUNTABILITY</h3>
                    <p>Colegio De Montalban is committed to building a community of responsible and productive citizens.</p>
                </div>

                <div class="values__container hidden">
                    <h3>MISSION</h3>
                    <p>To prepare students to become useful citizens, God-fearing, value-oriented, and disciplined
                        individuals who are universally competitive professionals engaged in uplifting
                        the quality of life in the community.
                    </p>
                </div>

                <div class="values__container hidden">
                    <h3>VISION</h3>
                    <p>Transform individuals into responsible citizens capable of meeting all the challenges of modern times.</p>
                </div>
            </div>
       </div>
    </div>

    <div class="footer__container" id="about">
       
        <div class="header__container">
                <img src="../public/image/cdmLogo.png" alt="" class="CdmLogo">
                <h3>Colegio De Montalban</h3>
        </div>

        <div class="footer__content">
            <div class="map__container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.3286187921!2d121.13906691005442!3d14.750506773330793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397bbe8733338e5%3A0xc845d7b6001522e1!2sColegio%20de%20Montalban!5e0!3m2!1sen!2sph!4v1731166646890!5m2!1sen!2sph" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
            <div class="info__box">
                <h3>Address</h3>
                <p>Kasiglahan Village, Rodriguez, Philippines</p>

                <h3>Follow us on:</h3>
                <a href="https://www.facebook.com/official.colegiodemontalban" class="social-icon">
                    <i class="fab fa-facebook"></i>
                </a>
                
            </div>

            <div class="info__box">
                <h3>Contact Information:</h3>
                <p>Email:  <a href="">info@cdm.edu.ph</a></p>
                <p>Phone:  <a href="">+63 (2) 555-XXXX</a></p>
                <p>Website:  <a href="">https://pnm.edu.ph/</a></p>
            </div>
        </div>

       
        <div id="ticketModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Ticket Request Fill-up Form</h2>
        
        <form action="/path/to/submit" method="post" enctype="multipart/form-data">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="institute">Institute:</label>
            <input type="text" id="institute" name="institute" required>

            <label for="concern">Concern:</label>
            <textarea id="concern" name="concern" rows="4" required></textarea>

            <label for="attachment">Attachment File:</label>
            <input type="file" id="attachment" name="attachment">

            <button type="submit" style="background-color: #054721; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px;">Submit</button>
        </form>
    </div>
</div>


<!-- Chat Section -->
<div class="support-icon-container">
        <i class="fas fa-comments" id="chat-icon"></i>
    </div>

    <!-- Chat Modal -->
    <div id="chatModal" class="chat-modal" style="display: none;">
        <div class="chat-modal-content">
            <div class="chat-header">
                <img src="../public/image/cdmLogo.png" alt="CDMCSS Logo" class="chat-logo">
                <h3>CDMCSS</h3>
               <span class="close-button" id="close-chat"><i class="fas fa-times"></i></span>
            </div>
            <div class="chat-box">
                <div class="messages" id="messages">
                    <!-- Demo Messages (empty to start) -->
                </div>
            </div>
            <div class="chat-footer">
                <input type="text" id="message-input" placeholder="Type your message..." />
                <button id="send-message">Send</button>
            </div>
        </div>
    </div>

    <script src="../js/Fadein.js"></script>
    <script src="../js/TicketModal.js"></script>
    <script src="../js/ChatModal.js"></script>
</body>
</html>
