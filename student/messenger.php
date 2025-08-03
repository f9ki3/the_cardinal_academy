<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger Style Chat Widget</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS for some utility classes -->

    <style>
        /* Base styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            position: relative;
        }
        
        /* Messenger logo button */
        .messenger-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #0084ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .messenger-button:hover {
            transform: scale(1.1);
            background-color: #0066cc;
        }
        
        .messenger-button i {
            color: white;
            font-size: 30px;
        }
        
        /* Chat container */
        .chat-container {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 350px;
            max-height: 500px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: translateY(20px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }
        
        .chat-container.open {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
        
        /* Chat header */
        .chat-header {
            background-color: #0084ff;
            color: white;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .chat-header h3 {
            margin: 0;
            font-weight: 600;
            flex-grow: 1;
        }
        
        .header-actions {
            display: flex;
            gap: 10px;
        }
        
        .group-chat-btn {
            background-color: transparent;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        
        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }
        
        /* Contacts list */
        .contacts-list {
            padding: 0;
            height: 350px;
            overflow-y: auto;
        }
        
        .contact {
            display: flex;
            padding: 10px 15px;
            align-items: center;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }
        
        .contact:hover {
            background-color: #f5f5f5;
        }
        
        .contact img {
            border-radius: 50%;
            margin-right: 10px;
            width: 32px;
            height: 32px;
        }
        
        .contact-info h4 {
            margin: 0;
            font-size: 14px;
        }
        
        .contact-info p {
            margin: 0;
            font-size: 12px;
            color: #777;
        }
        
        /* Chat messages */
        .chat-messages {
            padding: 15px;
            height: 350px;
            overflow-y: auto;
        }
        
        .message {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }
        
        .message.sent {
            align-items: flex-end;
        }
        
        .message.received {
            align-items: flex-start;
        }
        
        .message-content {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 20px;
            margin-top: 5px;
            word-break: break-word;
        }
        
        .message.sent .message-content {
            background-color: #0084ff;
            color: white;
            border-radius: 20px 20px 0 20px;
        }
        
        .message.received .message-content {
            background-color: #e5e5ea;
            color: black;
            border-radius: 20px 20px 20px 0;
        }
        
        /* Chat input */
        .chat-input {
            padding: 15px;
            border-top: 1px solid #eee;
            display: flex;
            background-color: #f8f8f8;
        }
        
        .chat-input input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 30px;
            outline: none;
            margin-right: 10px;
        }
        
        .chat-input button {
            background-color: #0084ff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .chat-input button:hover {
            background-color: #0066cc;
        }
    </style>
</head>
<body>
    <!-- Messenger Button -->
    <div class="messenger-button" id="messengerBtn">
        <i class="fab fa-facebook-messenger"></i>
    </div>
    
    <!-- Chat Container -->
    <div class="chat-container" id="chatContainer">
        <div class="chat-header">
            <h3 id="chatTitle">Contacts</h3>
            <div class="header-actions">
                <button class="group-chat-btn" id="groupChatBtn" title="Create group chat">
                    <i class="fas fa-users"></i>
                </button>
                <button class="group-chat-btn" id="addContactBtn" title="Add contact">
                    <i class="fas fa-user-plus"></i>
                </button>
                <button class="close-btn" id="closeBtn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        
        <div class="contacts-list" id="contactsList">
            <div class="contact" data-user="john">
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0b16b99a-4a15-4491-a8a9-ec8fbc6813b4.png" alt="John" width="32" height="32">
                <div class="contact-info">
                    <h4>John Doe</h4>
                    <p>Online</p>
                </div>
            </div>
            <div class="contact" data-user="jane">
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/08459a78-a871-48f4-a2ae-fb17a784f2c8.png" alt="Jane">
                <div class="contact-info">
                    <h4>Jane Smith</h4>
                    <p>Last seen 2h ago</p>
                </div>
            </div>
            <div class="contact" data-user="mike">
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/dba31c19-d4d4-40f0-a7f2-b5f630131953.png" alt="Mike">
                <div class="contact-info">
                    <h4>Mike Brown</h4>
                    <p>Active 5m ago</p>
                </div>
            </div>
            <div class="contact" data-user="sarah">
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b012482c-e234-4969-8568-bf75234c1583.png" alt="Sarah">
                <div class="contact-info">
                    <h4>Sarah Chen</h4>
                    <p>Offline</p>
                </div>
            </div>
            <div class="contact" data-user="david">
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/31628193-4668-450f-8afe-2f9f7d2c120a.png" alt="David">
                <div class="contact-info">
                    <h4>David Wilson</h4>
                    <p>Active now</p>
                </div>
            </div>
            <div class="contact" data-user="emma">
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/3892c857-2dd9-48ab-962f-631fdb36c26b.png" alt="Emma">
                <div class="contact-info">
                    <h4>Emma Parker</h4>
                    <p>Online</p>
                </div>
            </div>
        </div>
        
        <div class="chat-messages" id="chatMessages" style="display:none">
            <!-- Demo messages -->
            <div class="message received">
                <div class="message-content">
                    Hello! How can I help you today?
                </div>
            </div>
            
            <div class="message sent">
                <div class="message-content">
                    Hi there! I have a question.
                </div>
            </div>
        </div>
        
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Type a message...">
            <button id="sendBtn">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
    
    <script>
        // DOM Elements
        const messengerBtn = document.getElementById('messengerBtn');
        const groupChatBtn = document.getElementById('groupChatBtn');
        const addContactBtn = document.getElementById('addContactBtn');
        const chatContainer = document.getElementById('chatContainer');
        const closeBtn = document.getElementById('closeBtn');
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const chatMessages = document.getElementById('chatMessages');
        const contactsList = document.getElementById('contactsList');
        const chatTitle = document.getElementById('chatTitle');
        const contacts = document.querySelectorAll('.contact');
        
        // Button event listeners
        groupChatBtn.addEventListener('click', () => {
            alert('Group chat functionality will be added here!');
            // You can implement group chat creation logic here
        });
        
        addContactBtn.addEventListener('click', () => {
            const newContactName = prompt('Enter contact name:');
            if (newContactName) {
                // Add new contact to the list
                const newContact = document.createElement('div');
                newContact.className = 'contact';
                newContact.setAttribute('data-user', newContactName.toLowerCase().replace(/\s+/g, '-'));
                newContact.innerHTML = `
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/94375d33-1f13-405e-91e7-c46a191250b4.png" alt="${newContactName}">
                    <div class="contact-info">
                        <h4>${newContactName}</h4>
                        <p>Just added</p>
                    </div>
                `;
                contactsList.appendChild(newContact);
                newContact.addEventListener('click', () => {
                    startChat(newContactName);
                });
            }
        });
        
        // Toggle chat visibility
        messengerBtn.addEventListener('click', () => {
            chatContainer.classList.toggle('open');
            resetChat();
        });
        
        // Handle contact selection
        contacts.forEach(contact => {
            contact.addEventListener('click', () => {
                const userName = contact.getAttribute('data-user');
                startChat(userName);
            });
        });
        
        function resetChat() {
            chatMessages.style.display = 'none';
            contactsList.style.display = 'block';
            chatTitle.textContent = 'Contacts';
        }
        
        function startChat(userName) {
            contactsList.style.display = 'none';
            chatMessages.style.display = 'block';
            chatTitle.textContent = userName.charAt(0).toUpperCase() + userName.slice(1);
            // Clear previous messages
            chatMessages.innerHTML = '';
            // Add welcome message
            const welcomeMsg = createMessageElement(`Hello! You're now chatting with ${userName}`, 'received');
            chatMessages.appendChild(welcomeMsg);
        }
        
        closeBtn.addEventListener('click', () => {
            chatContainer.classList.remove('open');
        });
        
        // Send message function
        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
        
        function sendMessage() {
            const message = messageInput.value.trim();
            if (message === '') return;
            
            const messageElement = createMessageElement(message, 'sent');
            chatMessages.appendChild(messageElement);
            messageInput.value = '';
            
            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            // Simulate response after 1 second
            setTimeout(() => {
                const responseElement = createMessageElement("Thanks for your message! How can I assist you further?", 'received');
                chatMessages.appendChild(responseElement);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1000);
        }
        
        function createMessageElement(text, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${type}`;
            
            const contentDiv = document.createElement('div');
            contentDiv.className = 'message-content';
            contentDiv.textContent = text;
            
            messageDiv.appendChild(contentDiv);
            return messageDiv;
        }
    </script>
</body>
</html>

