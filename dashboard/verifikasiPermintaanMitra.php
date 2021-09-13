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

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM mebers WHERE id = $id";
    $result = $koneksi->query($sql);
    foreach ($result as $baris) { ?>
        <table class="table ">
            <tr>
                <td> Apakah anda yakin ingin memverifikasi permintaan mitra dengan username <b> <?php echo $baris['userid']; ?></b> ?</td>
            </tr>
        </table>
<?php

    }
}

$koneksi->close();
?>