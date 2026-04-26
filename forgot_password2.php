<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=grafino;charset=utf8mb4","root","");

    $email = $_POST['email'];

    // CHECK USER
    $stmt = $pdo->prepare("SELECT * FROM non_students WHERE contact_email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {

        // CREATE TOKEN
        $token = bin2hex(random_bytes(32));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // DELETE OLD TOKENS
        $pdo->prepare("DELETE FROM password_resets WHERE email = ?")->execute([$email]);

        // STORE TOKEN
        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$email, $token, $expires]);

        // RESET LINK
        $resetLink = "http://localhost/university/university-clearance/public/reset_password2.php?token=$token";

        // SEND EMAIL
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jaymothekingmall@gmail.com';
            $mail->Password   = 'ukxl dhpd pzno hhdf';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('jaymothekingmall@gmail.com', 'DIGITAL CLEARANCE');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "
                <h3>Password Reset</h3>
                <p>Click the link below:</p>
                <a href='$resetLink'>$resetLink</a>
                <p>This link expires in 1 hour.</p>
            ";

            $mail->send();

            $message = "Reset link sent to your email.";

        } catch (Exception $e) {
            $message = "Email failed: {$mail->ErrorInfo}";
        }

    } else {

        $message = "If the email exists, a reset link has been sent.";
    }
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #0056b3, #00c6ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.2);
        }

        h2 {
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #003f7d;
        }

        .message {
            margin-top: 15px;
            font-size: 14px;
        }
    </style>

</head>

<body>

<div class="box">

    <h2>Forgot Password</h2>
    <p>Enter your email to reset your password</p>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send Reset Link</button>
    </form>

    <div class="message">
        <?php echo $message; ?>
    </div>

    <br>
    <a href="adminlog.php">Back to Login</a>

</div>

</body>
</html>
