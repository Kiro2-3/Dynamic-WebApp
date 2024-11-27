const chatIcon = document.getElementById("chat-icon");
const chatModal = document.getElementById("chatModal");
const closeButton = document.getElementById("close-chat");
const sendButton = document.getElementById("send-message");
const messageInput = document.getElementById("message-input");
const messagesContainer = document.getElementById("messages");


chatIcon.addEventListener("click", function() {
    chatModal.style.display = "block"; 
});


closeButton.addEventListener("click", function() {
    chatModal.style.display = "none"; 
});


window.addEventListener("click", function(event) {
    if (event.target === chatModal) {
        chatModal.style.display = "none";
    }
});

// Send message
sendButton.addEventListener("click", function() {
    const userMessage = messageInput.value.trim();
    if (userMessage) {
       
        const userMessageElement = document.createElement("div");
        userMessageElement.classList.add("message", "from-user");
        userMessageElement.innerHTML = `<p>${userMessage}</p>`;
        messagesContainer.appendChild(userMessageElement);

       
        messageInput.value = '';

        
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

       
        setTimeout(function() {
            const supportReply = "I Miss You too";
            const supportMessageElement = document.createElement("div");
            supportMessageElement.classList.add("message", "from-support");
            supportMessageElement.innerHTML = `<p>${supportReply}</p>`;
            messagesContainer.appendChild(supportMessageElement);

         
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 1000); 
    }
});


messageInput.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        sendButton.click();
    }
});