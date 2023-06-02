<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Instantiation and passing `true` enables exceptions
function send_mail($send_to_mail, $send_to_fullname, $subject, $content)
{
    global $config;
    $config_email = $config['email'];
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP(); // gửi mail SMTP
        $mail->Host = $config_email['smtp_host']; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $config_email['smtp_user']; // SMTP username
        $mail->Password = $config_email['smtp_pass']; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = $config_email['smtp_port']; // TCP port to connect to
        $mail->CharSet = $config_email['charset'];
        
        //Recipients
        $mail->setFrom($config_email['smtp_user'], 'Hệ thống của hàng điện thoại ISMart');
        $mail->addAddress($send_to_mail, $send_to_fullname); // Add a recipient
        // $mail->addAddress('ellen@example.com'); // Name is optional
        $mail->addReplyTo($config_email['smtp_user'], 'Hệ thống của hàng điện thoại ISMart');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

        // Content
        $mail->isHTML(true);   // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Gửi mail thành công';
    } catch (Exception $e) {
        echo "Gửi mail không thành công. Mailer Error: {$mail->ErrorInfo}";
    }
}
