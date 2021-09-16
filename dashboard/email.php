<?php
$email = "deblenk.dh@gmail.com";
$name = "dede";
$userid = "mimi";
$passw = "lala";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once "vendor/phpmailer/src/PHPMailer.php";
require_once "vendor/phpmailer/src/Exception.php";
require_once "vendor/phpmailer/src/OAuth.php";
require_once "vendor/phpmailer/src/POP3.php";
require_once "vendor/phpmailer/src/SMTP.php";

$from_name = "Admin Tombo Ati";
$user_email = "adm.tomboati@gmail.com";
$pass_email = "TomboAti123";

$email_penerima = "deblenk.dh@gmail.com";
$penerima_nama = "Dedy";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->SMTPDebug = true;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $user_email;                     //SMTP username
    $mail->Password   = $pass_email;                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;  
    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
    //Recipients
    $mail->setFrom($user_email, $from_name);
    $mail->addAddress($email_penerima, $penerima_nama);     //Add a recipient
    $mail->addReplyTo($user_email, 'Information');
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    $body = "Yth. Bapak/Ibu $name.
    <br><br>
    Selamat permintaan anda untuk menjadi mitra telah disetujui. Berikut data diri akun anda : <br> 
    Username = $userid
    <br>
    Password = $passw
    <br><br>
    Berikut link untuk menuju ke halaman landing page referral anda. 
    <br>
    https://dash-tombo.bgskr-project.my.id/backoffice/
    
    <br>
    Terima Kasih
    <br>
    Admin Tombo Ati
    <br><br>
    
    <b>PENTING!</b>
    <p>Informasi yang disampaikan melalui e-mail ini hanya diperuntukkan bagi pihak penerima dan bersifat rahasia, jangan berikan informasi apapun kepada pihak lain demi keamanan akun Anda</p>
                ";
    //content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verifikasi Permintaan Mitra';
    $mail->Body    = $body;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $err_msg = 'Email telah terkirim'; 
    echo $err_msg;
} catch (Exception $e) {
    echo "Gagal mengirim email. Mailer Error: {$mail->ErrorInfo}";
    $err_msg = "Gagal mengirim email. Mailer Error: {$mail->ErrorInfo}"; 
    echo $err_msg;
}


