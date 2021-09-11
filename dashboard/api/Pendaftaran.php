<?php
require_once "config.php";
if (function_exists($_GET['function'])) {
    $_GET['function']();
}

function get_mitra()
{
    global $connect;
    $query = $connect->query("SELECT * FROM mebers");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }
    $response = array(
        'status' => 1,
        'message' => 'Success',
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}

function insert_pengguna()
{
    global $connect;
    $check = array('userid' => '', 'paket' => '', 'name' => '', 'hphone' => '', 'email' => '', 'passw' => '', 'kota' => '', 'kecamatan' => '', 'provinsi' => '', 'kodepos' => '', 'address' => '', 'country' => '', 'ktp' => '');
    $check_match = count(array_intersect_key($_POST, $check));
    if ($check_match == count($check)) {

        $result = mysqli_query($connect, "INSERT INTO mebers SET
               userid = '$_POST[userid]',
               paket = '$_POST[paket]',
               name = '$_POST[name]',
               hphone = '$_POST[hphone]',
               email = '$_POST[email]',
               passw = '$_POST[passw]',
               kota = '$_POST[kota]',
               kecamatan = '$_POST[kecamatan]',
               provinsi = '$_POST[provinsi]',
               kodepos = '$_POST[kodepos]',
               address = '$_POST[address]',
               country = '$_POST[country]',
               ktp = '$_POST[ktp]'");

        if ($result) {
            $response = array(
                'status' => 1,
                'message' => 'Insert Sukses'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Gagal insert data .'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Parameter Salah'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function register_post()
{
    global $connect;
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $ktp = $data['nomorktp'];
    $name = $data['nama'];
    $hphone = $data['nomorhp'];
    $email = $data['email'];
    $passw = $data['password'];
    $fotoktp = $data['fotoKTP'];
    $photo = $data['fotoProfil'];

    if (!mysqli_query($connect, "INSERT into mebers (ktp, name, hphone, email, passw, fotoktp, photo) values ('$ktp', '$name', '$hphone', '$email', '$passw', '$fotoktp', '$photo')")) {
        $status = array(
            'status' => "Error: %s\n", $connect->error
        );
    } else {
        $status = array(
            'status' => 1,
            'message'=>'success'
        );
    }

    echo json_encode($status);
}


    $fileName  =  $_FILES['sendimage']['name'];
    $tempPath  =  $_FILES['sendimage']['tmp_name'];
    $fileSize  =  $_FILES['sendimage']['size'];

    if (empty($fileName)) {
        $response = array(
            'error'     => true,
            'message'   => 'Silahkan memilih gambar'
        );
    } else {
        $upload_path = '../upload/users/'; // set upload folder path 

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png');

        // allow valid image file formats
        if (in_array($fileExt, $valid_extensions)) {
            if ($fileSize < 1000000) {
                move_uploaded_file($tempPath, $upload_path . $fileName);
            } else {
                $response = array(
                    'error'     => true,
                    'message'   => 'File maksimal 1MB'
                );
            }
        } else {
            $response = array(
                'error'     => true,
                'message'   => 'Maaf, Foto/Gambar harus berformat JPG, JPEG dan PNG'
            );
        }
    }