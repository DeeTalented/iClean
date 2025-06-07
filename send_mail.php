<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'mail.iclean.ng'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@iclean.ng';
        $mail->Password   = 'your_email_password_here'; // NEVER share this in public
        $mail->SMTPSecure = 'tls'; 
        $mail->Port       = 587;

        // Debugging (optional)
        // $mail->SMTPDebug = 2;

        // Sender and recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('info@iclean.ng', 'iClean Support'); // Replace with your receiving email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "<strong>Email:</strong> $subject";
        $mail->Body    = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Message:</strong><br>$message";

        $mail->send();
        echo "<h3>Message has been sent. Thank you!</h3>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
