const chatIcon = document.getElementById("chat-icon");
const chatModal = document.getElementById("chatModal");
const closeButton = document.getElementById("close-chat");
const sendButton = document.getElementById("send-message");
const messageInput = document.getElementById("message-input");
const messagesContainer = document.getElementById("messages");

// Open chat modal
chatIcon.addEventListener("click", function() {
    chatModal.style.display = "block"; // Show the chat modal
});

// Close chat modal
closeButton.addEventListener("click", function() {
    chatModal.style.display = "none"; // Close the chat modal
});

// Close chat modal when clicking outside the modal content
window.addEventListener("click", function(event) {
    if (event.target === chatModal) {
        chatModal.style.display = "none";
    }
});

// Send message
sendButton.addEventListener("click", function() {
    const userMessage = messageInput.value.trim();
    if (userMessage) {
        // Add user's message to the chat
        const userMessageElement = document.createElement("div");
        userMessageElement.classList.add("message", "from-user");
        userMessageElement.innerHTML = `<p>${userMessage}</p>`;
        messagesContainer.appendChild(userMessageElement);

        // Clear input field
        messageInput.value = '';

        // Scroll to the bottom of the chat
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Simulate response after a delay
        setTimeout(function() {
            const supportReply = "Thank you for messaging us, wait further for our response";
            const supportMessageElement = document.createElement("div");
            supportMessageElement.classList.add("message", "from-support");
            supportMessageElement.innerHTML = `<p>${supportReply}</p>`;
            messagesContainer.appendChild(supportMessageElement);

            // Scroll to the bottom of the chat
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 1000); // 1-second delay for simulated response
    }
});

// Optional: Allow pressing Enter to send message
messageInput.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        sendButton.click();
    }
});