<?php
include 'config.php';
include 'config2.php';

function randomPassword($panjang)
{
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}

//cara panggil random
$password = randomPassword(8);
$enc_password = md5($password);

//Update Mitra dan insert password
$id = $_POST['id'];
mysqli_query($koneksi, "UPDATE mebers SET paket='MITRA', passw='$password' WHERE id='$id'");
mysqli_query($koneksi2, "UPDATE USER_REGISTER SET STATUS_USER='MITRA', PASSWORD='$password' WHERE IDUSERREGISTER='$id'");

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once "vendor/phpmailer/src/PHPMailer.php";
require_once "vendor/phpmailer/src/Exception.php";
require_once "vendor/phpmailer/src/OAuth.php";
require_once "vendor/phpmailer/src/POP3.php";
require_once "vendor/phpmailer/src/SMTP.php";

$email = $_POST['email'];
$name = $_POST['name'];
$userid = $_POST['userid'];

$from_name = "Admin Tombo Ati";
$user_email = "adm.tomboati@gmail.com";
$pass_email = "TomboAti123";

$email_penerima = $email;
$penerima_nama = $name;

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
    $mail->SMTPDebug = true;                   
    $mail->isSMTP();                                        
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = $user_email;                   
    $mail->Password   = $pass_email;                         
    $mail->SMTPSecure = 'ssl';         
    $mail->Port       = 465;                                 

    //Recipients
    $mail->setFrom($user_email, $from_name);
    $mail->addAddress($email_penerima, $penerima_nama);     //Add a recipient
    $mail->addReplyTo($user_email, 'Information');
    // $mail->addAddress('ellen@example.com');              
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    $body = "
    <head>
    <style>
      p {color:black;}      
    </style>
  </head>

    <body style='color:black;'>
    <p>Yth. Bapak/Ibu $name.</p>
    <p>Selamat permintaan Anda untuk menjadi mitra telah disetujui. Berikut data diri akun Anda : </p>
    <br>
    <p>Username = <b>$userid</b> </p>
    <p>Password = <b>$password</b> </p>
    <br>
    <p>Berikut link untuk menuju ke halaman landing page referral Anda.</p> 
    https://dash-tombo.bgskr-project.my.id/backoffice/
    <br>
    <br>
    <p>Terima Kasih</p>
    <p>Admin Tombo Ati</p>
    <p>&copy; " . (int)date('Y') . " <strong>Tombo Ati</strong> All rights reserved</p>
    </body>

    <footer>
    <p><b>PENTING!</b></p>
    <p>Informasi yang disampaikan melalui e-mail ini hanya diperuntukkan bagi pihak penerima dan bersifat rahasia, jangan berikan informasi apapun kepada pihak lain demi keamanan akun Anda</p>
    </footer>        
    ";
    //content
    $mail->isHTML(true);
    $mail->Subject = 'Verifikasi Permintaan Mitra';
    $mail->Body    = $body;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $msg_success = 'Email telah terkirim';
    echo $msg_success;
} catch (Exception $e) {
    $msg_gagal = "Gagal mengirim email. Mailer Error: {$mail->ErrorInfo}";
    echo $msg_gagal;
}

header('location: VPermintaanMitra.php?output=berhasil');

