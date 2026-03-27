<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $service = $_POST['service'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Debugging (optional)
        $mail->SMTPDebug = 0;


        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        // ✅ App Password
        $mail->Username = 'iieccare@gmail.com';       // ✅ New Gmail ID
        $mail->Password = 'qxkqcfhsjwpplmyt';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender & Receiver
        $mail->setFrom('iieckochi@gmail.com', 'Website Contact');
        $mail->addAddress('iieckochi@gmail.com', 'Admin');

        $mail->setFrom('iieccare@gmail.com', 'Website Contact');
        $mail->addAddress('iieccare@gmail.com', 'Admin');
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Enquiry Form Submission';
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Service:</strong> $service</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        header("Location: index.html?success=true");
        exit();
    } catch (Exception $e) {
        echo '❌ Message could not be sent. Error: ' . $mail->ErrorInfo;
    }
}
?>