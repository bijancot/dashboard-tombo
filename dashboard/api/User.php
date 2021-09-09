<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

// include 'config.php'; // include database connection file
require_once "config.php";
if (function_exists($_GET['function'])) {
    $_GET['function']();
}
function register_post()
{
    global $connect;
    $data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
    $ktp = isset($_POST['nomorKTP']) ? $_POST['nomorKTP'] : '';
    $name = isset($_POST['nama']) ? $_POST['nama'] : '';
    $hphone = isset($_POST['nomorHP']) ? $_POST['nomorHP'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $passw = isset($_POST['password']) ? $_POST['password'] : '';

    $fileName  =  $_FILES['sendimage']['name'];
    $tempPath  =  $_FILES['sendimage']['tmp_name'];
    $fileSize  =  $_FILES['sendimage']['size'];

    if (empty($fileName)) {
        $errorMSG = json_encode(array("message" => "Silahkan memilih gambar", "status" => false));
        echo $errorMSG;
    } else {
        $upload_path = '../upload/users/'; // set upload folder path 

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png');

        // allow valid image file formats
        if (in_array($fileExt, $valid_extensions)) {
            if ($fileSize < 1000000) {
                move_uploaded_file($tempPath, $upload_path . $fileName);
            } else {
                $errorMSG = json_encode(array("message" => "Maaf, file anda terlalu besar. Silahkan upload ulang dengan ukuran maksimal 1 mb", "status" => false));
                echo $errorMSG;
            }
        } else {
            $errorMSG = json_encode(array("message" => "Maaf, Foto/Gambar harus berformat JPG, JPEG dan PNG", "status" => false));
            echo $errorMSG;
        }
    }

    $fotoProfil  =  $_FILES['sendimage']['name'];
    $tempPath  =  $_FILES['sendimage']['tmp_name'];
    $fileSize  =  $_FILES['sendimage']['size'];

    if (empty($fotoProfil)) {
        $errorMSG = json_encode(array("message" => "Silahkan memilih gambar", "status" => false));
        echo $errorMSG;
    } else {
        $upload_path = '../upload/users/'; // set upload folder path 

        $fileExt = strtolower(pathinfo($fotoProfil, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png');

        // allow valid image file formats
        if (in_array($fileExt, $valid_extensions)) {
            if ($fileSize < 1000000) {
                move_uploaded_file($tempPath, $upload_path . $fotoProfil);
            } else {
                $errorMSG = json_encode(array("message" => "Maaf, file anda terlalu besar.Silahkan upload ulang dengan ukuran maksimal 1 mb", "status" => false));
                echo $errorMSG;
            }
        } else {
            $errorMSG = json_encode(array("message" => "Maaf, Foto/Gambar harus berformat JPG, JPEG dan PNG", "status" => false));
            echo $errorMSG;
        }
    }

    if (!isset($errorMSG)) {
        !mysqli_query($connect, "INSERT into mebers (ktp, name, hphone, email, passw, fotoktp, photo) values ('$ktp', '$name', '$hphone', '$email', '$passw', '$fileName', '$fotoProfil')");

        echo json_encode(array("message" => "Sukses Register", "status" => true));
    }
}

function cek_nomor($hphone)
{
    global $connect;
    $query = "SELECT * FROM mebers WHERE hphone = '$hphone'";
    if ($result = mysqli_query($connect, $query)) return mysqli_num_rows($result);
}


function register_user($hphone, $sponsor)
{
    global $connect;
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $hphone = $data['nomorHP'];
    $sponsor = $data['referal'];
    $query = "INSERT INTO mebers (hphone, sponsor) VALUES('$hphone', '$sponsor') ON DUPLICATE KEY UPDATE hphone = '$hphone'";

    $user_new = mysqli_query($connect, $query);
    if ($user_new) {
        $usr = "SELECT * FROM mebers WHERE hphone = '$hphone'";
        $result = mysqli_query($connect, $usr);
        $user = mysqli_fetch_assoc($result);
        return $user;
    } else {
        return NULL;
    }
}


function registerNonMitra_post()
{
    $response = array("error" => FALSE);
    json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
    $hphone = isset($_POST['nomorHP']) ? $_POST['nomorHP'] : '';
    $sponsor = isset($_POST['referal']) ? $_POST['referal'] : '';
    
    if (cek_nomor($hphone) >= 0) {
        //mendaftarkan user baru
        $mebers = register_user($hphone, $sponsor);
        if ($mebers) {
            // simpan user berhasil
            $response["error"] = FALSE;
            $response["mebers"]["nomorHP"] = $mebers["hphone"];
            $response["mebers"]["referal"] = $mebers["sponsor"];
            echo json_encode($response);

        } else {
            // gagal menyimpan user
            $response["error"] = TRUE;
            $response["error_msg"] = "Terjadi kesalahan saat melakukan registrasi";
            echo json_encode($response);
        }
    } else {
        // user telah ada
        $response["error"] = TRUE;
        $response["error_msg"] = "Nomor Handphone sudah terdaftar ";
        echo json_encode($response);
    }

    // if (!isset($response)) {!mysqli_query($connect, "INSERT into mebers ( hphone, sponsor) values ('$hphone', '$sponsor')");

    //     echo json_encode(array("message" => "Sukses Register", "status" => true));
    // }
}

function coba()
{
    $response = array("error" => FALSE);
    $response = json_decode(file_get_contents("php://input"), true);
    global $connect;
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $hphone = $data['nomorHP'];
    $sponsor = $data['referal'];

   
        if ($hphone == '') {
            $response["error"] = TRUE;
            $response["error_msg"] = "Nomor Handphone Kosong ";
            echo json_encode($response);
           
        } else {
            $response = '';
        }
        if ($sponsor == '') {
            $response["error"] = TRUE;
            $response["error_msg"] = "Referal Kosong ";
            echo json_encode($response);
            
        } else {
            $response = '';
        }

        if ($hphone != '' && $sponsor != '') {
            $sel = mysqli_query($connect, "SELECT * FROM `mebers` WHERE hphone = '$hphone'");
            if (mysqli_num_rows($sel) > 0) {
                $response["error"] = TRUE;
                $response["error_msg"] = "Nomor Handphone sudah terdaftar ";
                echo json_encode($response);
            } else {
                $ins = mysqli_query($connect, "INSERT INTO `mebers` (hphone,sponsor) VALUES ('$hphone','$sponsor')");
                if ($ins) {
                    $response["error"] = TRUE;
                    $response["error_msg"] = "Sukses ";
                    echo json_encode($response);
                }
            }
        }
    }
