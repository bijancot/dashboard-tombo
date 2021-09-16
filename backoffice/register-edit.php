<?php
include('config.php');
include('fungsi.php');

session_start();

$id = $_POST['id'];
$upline = $_POST['upline'];


$sql_upline = mysqli_query($koneksi, "SELECT * FROM mebers WHERE userid='$upline'");
$total_upline = mysqli_num_rows($sql_upline);
if ($total_upline == 0) {
    echo '<script type="text/javascript">alert("Username Upline Tidak Ditemukan");</script>';
    echo "<script type='text/javascript'>document.location.href = 'register?error=Username Upline tidak Ditemukan&name=$name&userid=$userid&email=$email&hphone=$hphone&ktp=$ktp&fotoktp=$fotoktp&address=$address&kecamatan=$kecamatan&kota=$kota&propinsi=$propinsi&kode_pos=$kode_pos&country=$country&bank=$bank&rekening=$rekening&atasnama=$atasnama&upline=$upline';</script>";
}

$sql_username = mysqli_query($koneksi, "SELECT * FROM mebers WHERE userid='$userid'");
$total_username = mysqli_num_rows($sql_username);
if ($total_username !== 0) {
    echo '<script type="text/javascript">alert("Username Sudah Digunakan");</script>';
    echo "<script type='text/javascript'>document.location.href = 'register?error=Username Sudah Digunakan&name=$name&userid=$userid&email=$email&hphone=$hphone&ktp=$ktp&fotoktp=$fotoktp&address=$address&kecamatan=$kecamatan&kota=$kota&propinsi=$propinsi&kode_pos=$kode_pos&country=$country&bank=$bank&rekening=$rekening&atasnama=$atasnama&upline=$upline';</script>";
} else {
    // update data ke database
    if (mysqli_query($koneksi, "update mebers set upline='$upline' where id='$id'")) {
        echo "BERHASIL";
        // mengalihkan halaman kembali ke index.php
        header("location:register.php");
    } else {
        echo "GAGAL";
    }
}
