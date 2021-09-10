<?php
require_once "config.php";
require_once "config2.php";

if (function_exists($_GET['function'])) {
    $_GET['function']();
}

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

function registerMitra_post()
{
    global $connect, $connect2;

    $data = json_decode(file_get_contents("php://input"), true);
    $fotoktp  =  $_FILES['fotoktp']['name'];
    $tempPath  =  $_FILES['fotoktp']['tmp_name'];
    $fileSize  =  $_FILES['fotoktp']['size'];

    if (empty($fotoktp)) {
        $errorMSG = json_encode(array("message" => "File KTP Kosong", "status" => false));
        echo $errorMSG;
    } else {
        $upload_path = '../upload/users/'; // set upload folder path 

        $fileExt = strtolower(pathinfo($fotoktp, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png');

        if (in_array($fileExt, $valid_extensions)) {
            if (!file_exists($upload_path . $fotoktp)) {

                if ($fileSize < 2000000) {
                    move_uploaded_file($tempPath, $upload_path . $fotoktp);
                } else {
                    $errorMSG = json_encode(array("message" => "File KTP maksimal 2MB", "status" => false));
                    echo $errorMSG;
                }
            } else {
                $errorMSG = json_encode(array("message" => "File KTP tidak bisa diunggah, silahkan pilih file lainnya", "status" => false));
                echo $errorMSG;
            }
        } else {
            $errorMSG = json_encode(array("message" => "Hanya file JPG, JPEG & PNG", "status" => false));
            echo $errorMSG;
        }
    }

    $fotoprofil  =  $_FILES['fotoprofil']['name'];
    $tempPath  =  $_FILES['fotoprofil']['tmp_name'];
    $fileSize  =  $_FILES['fotoprofil']['size'];

    if (empty($fotoprofil)) {
        $errorMSG = json_encode(array("message" => "File Foto Profil Kosong", "status" => false));
        echo $errorMSG;
    } else {
        $upload_path = '../upload/users/'; // set upload folder path 

        $fileExt = strtolower(pathinfo($fotoprofil, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png');

        if (in_array($fileExt, $valid_extensions)) {
            if (!file_exists($upload_path . $fotoprofil)) {

                if ($fileSize < 2000000) {
                    move_uploaded_file($tempPath, $upload_path . $fotoprofil);
                } else {
                    $errorMSG = json_encode(array("message" => "File Foto Profil maksimal 2MB", "status" => false));
                    echo $errorMSG;
                }
            } else {
                $errorMSG = json_encode(array("message" => "File Foto Profil tidak bisa diunggah, silahkan pilih file lainnya", "status" => false));
                echo $errorMSG;
            }
        } else {
            $errorMSG = json_encode(array("message" => "Format Foto Profil  JPG, JPEG & PNG", "status" => false));
            echo $errorMSG;
        }
    }

    $buktiBayar  =  $_FILES['buktibayar']['name'];
    $tempPath  =  $_FILES['buktibayar']['tmp_name'];
    $fileSize  =  $_FILES['buktibayar']['size'];

    if (empty($buktiBayar)) {
        $errorMSG = json_encode(array("message" => "File Bukti Bayar Kosong", "status" => false));
        echo $errorMSG;
    } else {
        $upload_path = '../upload/users/'; // set upload folder path 

        $fileExt = strtolower(pathinfo($buktiBayar, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png');

        if (in_array($fileExt, $valid_extensions)) {
            if (!file_exists($upload_path . $buktiBayar)) {

                if ($fileSize < 2000000) {
                    move_uploaded_file($tempPath, $upload_path . $buktiBayar);
                } else {
                    $errorMSG = json_encode(array("message" => "File Bukti Bayar maksimal 2MB", "status" => false));
                    echo $errorMSG;
                }
            } else {
                $errorMSG = json_encode(array("message" => "File Bukti Bayar tidak bisa diunggah, silahkan pilih file lainnya", "status" => false));
                echo $errorMSG;
            }
        } else {
            $errorMSG = json_encode(array("message" => "Format file Bukti Bayar  JPG, JPEG & PNG", "status" => false));
            echo $errorMSG;
        }
    }

    $ktp =  $_POST['ktp'];
    $email =  $_POST['email'];
    $name =  $_POST['name'];
    $nomorHP =  $_POST['nomorHP'];
    $address =  $_POST['address'];
    $username =  $_POST['username'];
    $kecamatan =  $_POST['kecamatan'];
    $kota =  $_POST['kota'];
    $provinsi =  $_POST['provinsi'];
    $kode_pos = $_POST['kode_pos'];
    $country =  $_POST['country'];
    $bank =  $_POST['bank'];
    $rekening =  $_POST['rekening'];
    $atasnama = $_POST['atasnama'];
    $cabang     = $_POST['cabang'];
    $referral       = $_POST['referral'];
    $createdAt      = date('Y-m-d H:i:s');
    $idUserRegister = null;

    $get_all_data_register = $connect->query("SELECT * FROM mebers WHERE hphone ='" . $nomorHP . "'");
    $get_rows = mysqli_num_rows($get_all_data_register);
    
    if ($get_rows == null) {
        //db dashboard tombo
        mysqli_query($connect, "INSERT INTO mebers(paket,userid, ktp , email, name, sponsor, hphone, fotoktp, photo, bukti_bayar, address, kecamatan, kota, propinsi, kode_pos, country, bank, rekening, atasnama, cabang, timer) VALUES('BARU','$username','$ktp', '$email' , '$name', '$referral', '$nomorHP','$fotoktp','$fotoprofil','$buktiBayar', '$address', '$kecamatan', '$kota', '$provinsi', '$kode_pos', '$country', '$bank', '$rekening', '$atasnama', '$cabang','$createdAt')");

        //db tomboati
        mysqli_query($connect2, "INSERT INTO USER_REGISTER(NOMORKTP, EMAIL, NAMALENGKAP, KODEREFERRAL, NOMORHP, FILEKTP, FOTO, BUKTIBAYAR, ALAMAT, USERNAME, KECAMATAN, KOTA, PROVINSI, KODEPOS, NEGARA, BANK, REKENING, ATASNAMA, CABANG, CREATED_AT) VALUES('$ktp', '$email', '$name', '$referral', '$nomorHP','$fotoktp','$fotoprofil','$buktiBayar','$address', '$username', '$kecamatan', '$kota', '$provinsi', '$kode_pos', '$country', '$bank', '$rekening', '$atasnama', '$cabang','$createdAt')");
        
        $getID    = mysqli_query($connect2,"SELECT * FROM USER_REGISTER WHERE NOMORKTP = '".$ktp."'");

        $idUserRegister = $getID->fetch_array(MYSQLI_BOTH);

        mysqli_query($connect2, "INSERT INTO CHAT_ROOM SET IDUSERREGISTER ='".$idUserRegister['IDUSERREGISTER']."'");
        
        $response = array(
            'error'     => false,
            'message'   => 'Sukses Register'
        );
    } else {
        $response = array(
            'error'     => true,
            'message'   => 'Gagal Register'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function login_post()
{
    global $connect, $connect2;
    $response       = [];
    $email          = $_POST['email'];
    $password       = $_POST['password'];
    $user_token     = $_POST['token'];


    $data = [];

    $get_all_data_register = $connect2->query("SELECT * FROM USER_REGISTER JOIN CHAT_ROOM ON CHAT_ROOM.IDUSERREGISTER = USER_REGISTER.IDUSERREGISTER WHERE EMAIL ='" . $email . "' AND PASSWORD='" . $password . "'");
    $get_rows = mysqli_num_rows($get_all_data_register);


    if ($get_rows > 0) {
        mysqli_query($connect, "UPDATE mebers SET usertoken='" . $user_token . "' WHERE email='" . $email . "'");

        mysqli_query($connect2, "UPDATE USER_REGISTER SET USERTOKEN='" . $user_token . "' WHERE EMAIL='" . $email . "'");

        $get_data_by_email = mysqli_query($connect2, "SELECT * FROM USER_REGISTER  WHERE EMAIL ='" . $email . "' AND PASSWORD='" . $password . "'");
        $get_rows = mysqli_num_rows($get_data_by_email);

        while ($row = mysqli_fetch_object($get_data_by_email)) {
            $data[] = $row;
        }
        $response = array(
            'error'     => false,
            'message'   => 'Sukses Login',
            'data'      => $data
        );
    } else {
        $response = array(
            'error'     => true,
            'message'   => 'Gagal Login'
            
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function logout_post()
{
    global $connect, $connect2;
    $response       = [];
    $email          = $_POST['email'];

    $get_data_by_email = $connect2->query("SELECT * FROM USER_REGISTER  WHERE EMAIL ='" . $email . "'");
    $get_rows = mysqli_num_rows($get_data_by_email);

    if ($get_rows >= 0) {
        mysqli_query($connect, "UPDATE mebers SET usertoken='" . null . "' WHERE email='" . $email . "'");

        mysqli_query($connect2, "UPDATE USER_REGISTER SET USERTOKEN='" . null . "' WHERE EMAIL='" . $email . "'");

        $response = array(
            'error'     => false,
            'message'   => 'Sukses Logout'
        );
    } else {
        $response = array(
            'error'     => true,
            'message'   => 'Gagal Logout'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
