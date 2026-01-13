<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Chat</title>
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #f8f9fa;
            --text-color: #333;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
        }

        #chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            border-radius: 50%;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        #chat-button:hover {
            transform: scale(1.1);
        }

        #chat-popup {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 320px;
            max-height: 500px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            display: none;
            flex-direction: column;
            z-index: 1000;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }

        #chat-popup.active {
            display: flex;
            opacity: 1;
            transform: translateY(0);
        }

        #chat-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #registration-form {
            padding: 20px;
            background-color: white;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-color);
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        #chat-messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 15px;
            background-color: var(--secondary-color);
            display: none;
        }

        #message-input {
            display: none;
            padding: 10px;
            background-color: white;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        #message-input input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-right: 10px;
        }

        #message-input button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 15px;
            cursor: pointer;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            max-width: 80%;
            clear: both;
        }

        .sent {
            background-color: var(--primary-color);
            color: white;
            float: right;
            text-align: right;
        }

        .received {
            background-color: #e9ecef;
            float: left;
            text-align: left;
        }

        @media (max-width: 480px) {
            #chat-popup {
                width: calc(100% - 40px);
                right: 20px;
                bottom: 80px;
            }
        }
    </style>
</head>

<body>
    <button id="chat-button" onclick="toggleChat()">💬</button>

    <div id="chat-popup">
        <div id="chat-header">
            <span>Chat Support</span>
            <button onclick="toggleChat()" style="background:none; border:none; color:white;">✕</button>
        </div>

        <div id="registration-form">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Nomor Telepon:</label>
                <input type="tel" id="phone" required>
            </div>
            <button onclick="startChat()"
                style="width: 100%; padding: 10px; background-color: var(--primary-color); color: white; border: none; border-radius: 6px; cursor: pointer;">
                Mulai Chat
            </button>
        </div>

        <div id="chat-messages"></div>

        <div id="message-input">
            <input type="text" id="message-text" placeholder="Ketik pesan Anda...">
            <button onclick="sendMessage()">Kirim</button>
        </div>
    </div>

    <script>
        class PopupChat {
            constructor() {
                this.chatPopup = document.getElementById('chat-popup');
                this.registrationForm = document.getElementById('registration-form');
                this.messagesContainer = document.getElementById('chat-messages');
                this.messageInput = document.getElementById('message-input');
                this.messageText = document.getElementById('message-text');
                this.userInfo = null;

                this.initializeEventListeners();
            }

            initializeEventListeners() {
                this.messageText.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.sendMessage();
                    }
                });
            }

            toggleChat() {
                this.chatPopup.classList.toggle('active');
                if (this.chatPopup.classList.contains('active') && this.userInfo) {
                    this.scrollToBottom();
                }
            }

            startChat() {
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const phone = document.getElementById('phone').value.trim();

                if (!name || !email || !phone) {
                    alert('Mohon isi semua data');
                    return;
                }

                this.userInfo = {
                    name,
                    email,
                    phone
                };
                this.registrationForm.style.display = 'none';
                this.messagesContainer.style.display = 'block';
                this.messageInput.style.display = 'flex';

                // Welcome message
                this.displayMessage({
                    text: `Selamat datang ${name}! Ada yang bisa kami bantu?
                    Anda juga dapat mengunduh Brosur dan Pricelist kami di sini: <a href="https://www.formsliving.com/download-pdf" target="_blank" style="color: var(--primary-color); text-decoration: none; font-weight: bold;">Download Pricelist</a>`,
                    sender: 'Support',
                    timestamp: new Date().toLocaleTimeString(),
                    type: 'received'
                });
                
            }

            async sendMessage() {
                const messageText = this.messageText.value.trim();

                if (!messageText) return;

                const message = {
                    text: messageText,
                    sender: this.userInfo.name,
                    timestamp: new Date().toLocaleTimeString(),
                    type: 'sent'
                };

                this.displayMessage(message);
                this.messageText.value = '';
                this.scrollToBottom();

                // Send message to Laravel API
                const response = await fetch('/api/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: messageText
                    })
                });

                const data = await response.json();
                if (data.response) {
                    this.displayMessage({
                        text: data.response,
                        sender: 'Support',
                        timestamp: new Date().toLocaleTimeString(),
                        type: 'received'
                    });
                    this.scrollToBottom();
                }
            }

            displayMessage(message) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message', message.type);

                messageElement.innerHTML = `
                    <strong>${message.sender}</strong><br>
                    ${message.text}<br>
                    <small style="font-size:0.7em;color:#666;">${message.timestamp}</small>
                `;

                this.messagesContainer.appendChild(messageElement);
            }

            scrollToBottom() {
                this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
            }
        }

        // Global instance and functions
        let popupChat;

        function toggleChat() {
            if (!popupChat) {
                popupChat = new PopupChat();
            }
            popupChat.toggleChat();
        }

        function startChat() {
            if (!popupChat) {
                popupChat = new PopupChat();
            }
            popupChat.startChat();
        }

        function sendMessage() {
            if (!popupChat) {
                popupChat = new PopupChat();
            }
            popupChat.sendMessage();
        }
    </script>
</body>

</html>
