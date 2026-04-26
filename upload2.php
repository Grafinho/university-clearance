<?php
include 'config.php'; // Database connection

if (isset($_POST["submit"])) {
    $studentid = $_POST["student_id"];
    $studentname = $_POST["student_name"];
    $documenttype = $_POST["document_type"];
    $title = $_POST["title"];
    $file = $_FILES["file"]["tmp_name"]; // Get temporary file path
    $fileType = $_FILES["file"]["type"];
    $fileSize = $_FILES["file"]["size"];

    // Check file size (5 MB = 5 * 1024 * 1024 bytes)
    if ($fileSize > 5 * 1024 * 1024) {
        echo "Error: File size exceeds the 5MB limit.";
        exit();
    }

    if ($file) {
        // Read file content
        $fileData = file_get_contents($file);

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO uploaded_files (student_id, student_name, document_type, title, file_data, file_type, file_size) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssbsi", $studentid, $studentname, $documenttype, $title, $fileData, $fileType, $fileSize);

        if ($stmt->execute()) {
            echo "File successfully uploaded!";
        } else {
            echo "Error uploading file.";
        }

        $stmt->close();
    } else {
        echo "Please select a file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Documents - University Clearance System</title>
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
        /* Form styling */
        form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        .uploaded-files {
            margin-top: 20px;
        }

        .uploaded-files ul {
            list-style-type: none;
            padding-left: 0;
        }

        .uploaded-files li {
            margin: 5px 0;
        }

        .sidebar.hidden {
            display: none;
        }

    </style>
</head>
<body>
<img src="http://localhost/university/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

<div class="hamburger-menu" onclick="toggleSidebar()">
    <div></div>
    <div></div>
    <div></div>
</div>
<!-- Header -->
<header>
    <h1>Upload Documents - University Clearance System</h1>
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

<!-- Main Content -->
<main>
    <h2>Upload Documents for Clearance</h2>
    <p>Please upload the required documents for your clearance process. Select the type of document, choose the file, and click "Submit" once finished.</p>

    <form action="" method="post" enctype="multipart/form-data">
        <label>File Title:</label>
        <input type="text" name="title" required>
        <br>
        <label for="student-id">Student ID:</label>
        <input type="text" name="student_id" id="student-id" placeholder="Enter your Student ID" required>

        <label for="student-name">Student Name:</label>
        <input type="text" name="student_name" id="student-name" placeholder="Enter your name" required>

        <label for="document-type">Document Type:</label>
        <select name="document_type" id="document-type" required>
            <option value="">Select Document Type</option>
            <option value="student-id">Student ID</option>
            <option value="national-id">National ID</option>
            <option value="bank-receipt">Bank Receipt</option>
            <option value="payment-receipt">Payment Receipt</option>
            <option value="birth-certificate">Birth Certificate</option>
            <option value="transcript">Transcript</option>
            <option value="passport">Passport</option>
            <option value="student-photo">Student Photo</option>
            <option value="medical-certificate">Medical Certificate</option>
            <option value="tuition-fee-receipt">Tuition Fee Receipt</option>
            <option value="hostel-fee-receipt">Hostel Fee Receipt</option>
            <option value="course-registration">Course Registration Form</option>
            <option value="clearance-form">Clearance Form</option>
            <option value="other">Other</option>
        </select>

        <label>Select File:</label>
        <input type="file" name="file" required>
        <br>
        <button type="submit" name="submit">Upload</button>
    </form>

        <script src="upload.js"></script> <!-- JavaScript for upload behavior -->

    <script>
        // Toggle sidebar visibility
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
        }

        // Handle file uploads and list uploaded files
        const fileInput = document.getElementById('documents');
        const fileList = document.getElementById('file-list');

        // Update file list when files are selected
        fileInput.addEventListener('change', function() {
            const files = this.files;
            fileList.innerHTML = ''; // Clear current list

            // Loop through the selected files and add them to the list
            for (let i = 0; i < files.length; i++) {
                const listItem = document.createElement('li');
                listItem.textContent = files[i].name;
                fileList.appendChild(listItem);
            }
        });

        // Handle form submission
        document.getElementById('upload-form').addEventListener('submit', function(event) {
            event.preventDefault();

            // In a real scenario, you would send the form data to the backend for processing
            alert('Documents uploaded successfully!');
            // For now, just clear the file list and form after submission
            fileList.innerHTML = '';
            fileInput.value = '';
            document.getElementById('student-id').value = '';
            document.getElementById('student-name').value = '';
            document.getElementById('document-type').value = '';
        });
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const hamburger = document.getElementById('hamburger');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('expanded');
        });
    </script>
</body>
</html>
</title>
</head>
<body>

</body>
</html>
<footer>
    <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
</footer>

<script src="upload.js"></script> <!-- JavaScript for upload behavior -->

<script>
    // Toggle sidebar visibility
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('hidden');
    }

    // Handle file uploads and list uploaded files
    const fileInput = document.getElementById('documents');
    const fileList = document.getElementById('file-list');

    // Update file list when files are selected
    fileInput.addEventListener('change', function() {
        const files = this.files;
        fileList.innerHTML = ''; // Clear current list

        // Loop through the selected files and add them to the list
        for (let i = 0; i < files.length; i++) {
            const listItem = document.createElement('li');
            listItem.textContent = files[i].name;
            fileList.appendChild(listItem);
        }
    });

    // Handle form submission
    document.getElementById('upload-form').addEventListener('submit', function(event) {
        event.preventDefault();

        // In a real scenario, you would send the form data to the backend for processing
        alert('Documents uploaded successfully!');
        // For now, just clear the file list and form after submission
        fileList.innerHTML = '';
        fileInput.value = '';
        document.getElementById('student-id').value = '';
        document.getElementById('student-name').value = '';
        document.getElementById('document-type').value = '';
    });
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const hamburger = document.getElementById('hamburger');

    hamburger.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
        mainContent.classList.toggle('expanded');
    });
        // Check file size before form submission
        document.querySelector('form').addEventListener('submit', function(event) {
        const fileInput = document.querySelector('input[type="file"]');
        const file = fileInput.files[0];

        if (file && file.size > 5 * 1024 * 1024) { // 5 MB
        alert("Error: The selected file exceeds the 5MB size limit.");
        event.preventDefault(); // Stop form submission
    }
    });
</script>
</html>
</title>
</head>
<body>

</body>
</html>

</body>
</html>
