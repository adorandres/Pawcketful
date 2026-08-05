<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="css/customer.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f6f6f9;
            margin: 0;
            display: flex;
        }

        .customer-dashboard {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #0991be;
            color: #fff;
            padding: 1.5rem;
            border-radius: 0 20px 20px 0;
            box-shadow: 5px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 0.8rem;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover,
        .sidebar ul li.active a {
            background: rgba(255,255,255,0.2);
        }

        /* Chat container */
        .chat-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #fff;
            border-radius: 20px;
            margin: 1.5rem;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .chat-header {
            background: #0991be;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        .chat-box {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .bot-message, .user-message {
            max-width: 70%;
            padding: 0.8rem 1rem;
            border-radius: 15px;
            line-height: 1.4;
        }

        .bot-message {
            background: #e9f5ff;
            align-self: flex-start;
        }

        .user-message {
            background: #0991be;
            color: #fff;
            align-self: flex-end;
        }

        .chat-input {
            display: flex;
            padding: 1rem;
            border-top: 1px solid #ddd;
        }

        .chat-input input {
            flex: 1;
            padding: 0.8rem;
            border-radius: 20px;
            border: 1px solid #ccc;
            outline: none;
        }

        .chat-input button {
            background: #0991be;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 0.8rem 1.5rem;
            margin-left: 0.5rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .chat-input button:hover {
            background: #077aa0;
        }
    </style>
</head>
<body>
    
<div class="customer-dashboard">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Pawcketful Chat</h2>
        <ul>
            <li class="active"><a href="customer_dashboard.php">Chat Bot</a></li>
            <li><a href="appointment_customer.php">Appointments</a></li>
            <li><a href="pet_records.php">Pet Records</a></li>
            <li><a href="setting_customer.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Chat Section -->
    <div class="chat-container">
        <div class="chat-header">
            <h3>Welcome, Customer!</h3>
            <small>Ask me anything about your pets 🐾</small>
        </div>

        <div class="chat-box" id="chat-box">
            <div class="bot-message">
                <p>Hi there! I’m PawBot 🐶 — how can I help you today?</p>
            </div>
        </div>

        <div class="chat-input">
            <input type="text" id="user-input" placeholder="Type your message...">
            <button id="send-btn">Send</button>
        </div>
    </div>
</div>

<!-- Chat Script -->
<script>
const sendBtn = document.querySelector('#send-btn');
const userInput = document.querySelector('#user-input');
const chatBox = document.querySelector('#chat-box');

sendBtn.addEventListener('click', sendMessage);
userInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') sendMessage();
});

function sendMessage() {
    const message = userInput.value.trim().toLowerCase();
    if (message === '') return;

    const userMsg = document.createElement('div');
    userMsg.classList.add('user-message');
    userMsg.innerHTML = `<p>${userInput.value}</p>`;
    chatBox.appendChild(userMsg);
    userInput.value = '';
    chatBox.scrollTop = chatBox.scrollHeight;

    setTimeout(() => {
        const botMsg = document.createElement('div');
        botMsg.classList.add('bot-message');
        botMsg.innerHTML = `<p>${getBotReply(message)}</p>`;
        chatBox.appendChild(botMsg);
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 800);
}

function getBotReply(msg) {
    if (msg.includes('book') || msg.includes('appointment')) {
        return 'To book an appointment, go to the **Appointments** section and fill out the form with your pet’s details, service, date, and time.';
    } 
    else if (msg.includes('service') || msg.includes('offer')) {
        return 'We currently offer **Cesarean Section Delivery**, **Spay**, **Neutering**, **Vaccination**, and **Treatment & Confinement**.';
    } 
    else if (msg.includes('payment') || msg.includes('gcash') || msg.includes('cash')) {
        return 'You can pay via **Cash** or **GCash** during your visit.';
    } 
    else if (msg.includes('time') || msg.includes('open')) {
        return 'Our clinic is open **Monday to Saturday, 8 AM – 5 PM**.';
    } 
    else if (msg.includes('hello') || msg.includes('hi')) {
        return 'Hi there! 🐾 I’m PawBot — your friendly assistant. You can ask me about booking, services, or payments.';
    } 
    else {
        return 'Hmm… I’m not sure about that yet. Try asking about **how to book**, **services**, or **payment options**.';
    }
}


setTimeout(() => {
    const typing = document.createElement('div');
    typing.classList.add('bot-message');
    typing.innerHTML = '<p><i>PawBot is typing...</i></p>';
    chatBox.appendChild(typing);
    chatBox.scrollTop = chatBox.scrollHeight;

    setTimeout(() => {
        typing.remove();
        const botMsg = document.createElement('div');
        botMsg.classList.add('bot-message');
        botMsg.innerHTML = `<p>${getBotReply(message)}</p>`;
        chatBox.appendChild(botMsg);
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 1000);
}, 500);

</script>

</body>
</html>
