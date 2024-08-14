<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

// Uploading variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// PHPMailer configuration
$mail = new PHPMailer(true);

try {
    // SMTP server settings
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USERNAME'];
    $mail->Password = $_ENV['SMTP_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $_ENV['SMTP_PORT'];

    // Expedition and reception of the email
    $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']);
    $mail->addAddress('destinataire@example.com');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Nouveau message de contact';
    $mail->Body    = 'Voici le message de contact...';

    // Sending the email
    $mail->send();
    echo 'Votre message a bien été envoyé !';
} catch (Exception $e) {
    echo "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
}
?>