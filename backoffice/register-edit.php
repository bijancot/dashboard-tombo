<?php
include('config.php');
include('fungsi.php');

session_start();

$id = $_POST['id'];
$upline = $_POST['upline'];

// update data ke database
if(mysqli_query($koneksi,"update mebers set upline='$upline' where id='$id'")){
    echo "BERHASIL";
    // mengalihkan halaman kembali ke index.php
    header("location:register.php");
}else{
    echo "GAGAL";
}

?>