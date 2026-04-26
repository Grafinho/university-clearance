<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'grafino', 3307);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed.");
}

// Set charset
$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $username = $_POST['username'];
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $message  = $_POST['message'];

    // Validate
    if (empty($username) || empty($name) || empty($email) || empty($message)) {
        die("Please fill in all required fields.");
    }

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO messages (username, name, email, message) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $username, $name, $email, $message);

    // Execute
    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='support.php';</script>";
    } else {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support - University Clearance System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your stylesheet -->
    <style>
        /* Sidebar hidden class */
        .sidebar.hidden {
            display: none;
        }

        /* Hamburger menu button */
        .hamburger-menu {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 30px;
            height: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
            z-index: 1000;
        }

        /* Hamburger menu lines */
        .hamburger-menu div {
            width: 100%;
            height: 4px;
            background-color: #ffffff;
            border-radius: 2px;
        }

        /* Hover effect for the hamburger menu */
        .hamburger-menu:hover div {
            background-color: #0056b3;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0056b3;
            color: white;
            text-align: center;
            padding: 15px 0;
        }

        main {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px #ccc;
            border-radius: 5px;
        }

         {
            color: #0056b3;
        }

        .faq-section {
            margin-bottom: 20px;
        }

        .faq-item {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .faq-item h3 {
            cursor: pointer;
            color: #0056b3;
        }

        .faq-item p {
            display: none;
            margin-top: 5px;
        }

        .contact-form {
            background: #f8f8f8;
            padding: 15px;
            border-radius: 5px;
        }

        .contact-form label {
            font-weight: bold;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .contact-form button {
            background: #0056b3;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .contact-form button:hover {
            background: #003f7d;
        }

        .chat-box {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #0056b3;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .chat-box:hover {
            background: #003f7d;
        }

        .chat-popup {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            background: white;
            width: 300px;
            box-shadow: 0px 0px 10px #ccc;
            border-radius: 5px;
            padding: 10px;
        }

        .chat-popup textarea {
            width: 100%;
            height: 60px;
            padding: 5px;
            margin-bottom: 5px;
        }

        .chat-popup button {
            width: 100%;
            padding: 8px;
            background: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .chat-popup button:hover {
            background: #003f7d;
        }
    </style>
</head>
<body>
<img src="http://localhost/university/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">
<h3>Help & Support</h3>
<!-- Hamburger Menu for Toggling Sidebar -->
<div class="hamburger-menu" onclick="toggleSidebar()">
    <div></div>
    <div></div>
    <div></div>
</div>
<!-- Main Content -->
<div class="main-content" id="main-content">
    <header>

        <div class="hamburger" id="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="header-content">
            <h1>University Clearance System</h1>
        </div>
    </header>
    <!-- Navigation Sidebar -->
    <aside class="sidebar">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="departments.html">Departments</a></li>
                <li><a href="requests.php">Requests</a></li>
                <li><a href="upload2.php">Upload Documents</a></li>
                <li><a href="payment.html">Payment</a></li>
                <li><a href="support.php">Help & Support</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </nav>
    </aside>

    <main>
        <section class="faq-section">
            <h2>Frequently Asked Questions (FAQs)</h2>

            <div class="faq-item">
                <h3>1. How do I upload my clearance documents?</h3>
                <p>Go to the "Upload Documents" page, fill in the required details, select the file, and click "Submit".</p>
            </div>

            <div class="faq-item">
                <h3>2. What file formats are supported?</h3>
                <p>You can upload PDF, PNG, JPG, and DOCX files.</p>
            </div>

            <div class="faq-item">
                <h3>3. How long does clearance approval take?</h3>
                <p>It usually takes 24-48 hours for the relevant department to verify your documents.</p>
            </div>

            <div class="faq-item">
                <h3>4. I uploaded the wrong document, how can I delete it?</h3>
                <p>Contact the university clearance office for assistance at <strong>clearance@university.com</strong>.</p>
            </div>
        </section>

        <section class="contact-form">
            <h2>Contact Support</h2>
            <form action="support.php" method="POST">
                <label for="username">Userame:</label>
                <input type="text" id="username" name="username" required>
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Your Message:</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </section>
    </main>

    <!-- Live Chat Box -->
    <div class="chat-box" onclick="toggleChat()">💬 Live Chat</div>

    <div class="chat-popup" id="chatPopup">
        <h3>Live Chat Support</h3>
        <textarea placeholder="Type your message..."></textarea>
        <button onclick="sendMessage()">Send</button>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
    </footer>
    <script>
        // Toggle FAQ answers
        document.querySelectorAll(".faq-item h3").forEach((faq) => {
            faq.addEventListener("click", () => {
                const answer = faq.nextElementSibling;
                answer.style.display = (answer.style.display === "block") ? "none" : "block";
            });
        });

        // Toggle live chat popup
        function toggleChat() {
            const chatPopup = document.getElementById("chatPopup");
            chatPopup.style.display = (chatPopup.style.display === "block") ? "none" : "block";
        }

        // Dummy function for chat
        function sendMessage() {
            alert("Your message has been sent to support!");
            document.querySelector("#chatPopup textarea").value = "";
        }
        // Function to toggle the sidebar visibility
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>

</body>
</html>

