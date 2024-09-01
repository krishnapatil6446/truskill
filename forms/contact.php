<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Load Composer's autoloader (assuming PHPMailer is installed via Composer)
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    // Create an instance; passing true enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kp909065@gmail.com'; // Your Gmail address
        $mail->Password   = ''; // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->setFrom('kp909065@gmail.com', 'Contact Form');
        $mail->addAddress('kp1250225@gmail.com', 'Recipient Name'); // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name <br>Email: $email<br>Message: $message";

        // Send the email
        $mail->send();
        echo '<div class="sent-message">Your message has been sent. Thank you!</div>';
    } catch (Exception $e) {
        echo '<div class="error-message">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
    }
}
?>