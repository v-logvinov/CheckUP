<?php
$_POST = json_decode(file_get_contents('php://input'), true);

if (empty($_POST['telephone']) || empty($_POST['name'])) {
    echo json_encode(['success' => false]);
    die();
};

require_once('./vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailEx;
use PHPMailer\PHPMailer\SMTP;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$_POST = json_decode(file_get_contents('php://input'), true);
$mail = new PHPMailer(true);
$mail->CharSet = "UTF-8";
try {
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host       = 'smtp.mail.ru';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'qwe.1982@internet.ru';
    $mail->Password   = '8NdfrXZGdumShXpTyfgg';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('qwe.1982@internet.ru', 'Valeri Logvinov');
    $mail->addAddress($_ENV['EMAIL']);

    $mail->isHTML(true);
    $mail->Subject = 'Новая Заявка';
    $num = $_POST['telephone'];
    $name = $_POST['name'];
    $mail->Body    = "Номер клиента - $num, Имя клиента - $name";
    $mail->send();
    echo json_encode(['success' => true]);
} catch (MailEx $e) {
    $sendError = true;
    $dateTime = new DateTime();
    $dateTime = $dateTime->format('Y-m-d H:i:s');
    file_put_contents('error.log', "Message could not be sent. Mailer Error: {$mail->ErrorInfo} datetime: $dateTime \n", FILE_APPEND);
    echo json_encode(['success' => false]);
}
