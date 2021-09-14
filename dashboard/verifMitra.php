<?php
$servername = "dash-tombo.bgskr-project.my.id";
$username = "dash_tombo";
$password = "1sampaitombo";
$dbname = "dash_tombo";

// membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// melakukan pengecekan koneksi
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

$id = $_POST['id'];
mysqli_query($koneksi, "UPDATE mebers SET paket='MITRA' WHERE id='$id'");
header('location: VPermintaanMitra.php?output=berhasil');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
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
$passw = $_POST['passw'];

$from_name = "Admin Tombo Ati";
$user_email = "anisarindu95@gmail.com";
$pass_email = "rinduanisa95";

$email_penerima = $email;
$penerima_nama = $name;

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
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

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
    Berikut link untuk menuju ke halaman referral anda. 
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
    $msg_success = 'Email telah terkirim';
    echo $msg_success;
} catch (Exception $e) {
    $msg_gagal = "Gagal mengirim email. Mailer Error: {$mail->ErrorInfo}";
    echo $msg_gagal;
}

$koneksi->close();
