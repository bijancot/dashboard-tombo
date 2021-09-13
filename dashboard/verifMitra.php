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


$id = $_POST['rowid'];
mysqli_query($koneksi, "UPDATE mebers SET paket='MITRA' WHERE id='$id'");

header('location: VPermintaanMitra.php');

$koneksi->close();
