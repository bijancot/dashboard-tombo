<?php
session_start();
include 'header.php';

$query_point = mysqli_query($koneksi, "SELECT SUM(jumlah) as 'total_point' FROM hm2_pending_deposits WHERE status='processed' AND type='point' AND user_id='$row[id]' ");
$query_total2 = mysqli_fetch_array($query_point);
$point_total = $query_total2['total_point'];

$error = $_GET['error'];
$userid = $_GET['userid'];
$name = $_GET['name'];
$hphone = $_GET['hphone'];
$email = $_GET['email'];
$ktp = $_GET['ktp'];
$fotoktp = $_GET['fotoktp'];
$address = $_GET['address'];
$kecamatan = $_GET['kecamatan'];
$kota = $_GET['kota'];
$propinsi = $_GET['propinsi'];
$kode_pos = $_GET['kode_pos'];
$country = $_GET['country'];
$bank = $_GET['bank'];
$rekening = $_GET['rekening'];
$atasnama = $_GET['atasnama'];
$username = $row['userid'];
$upline = $_GET['upline'];

if (isset($_POST['button'])) {

    function acak2($panjang)
    {
        $karakter = '0123456789';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{
                $pos};
        }
        return $string;
    }
    $unik_password = acak2(8);
    $unik_transaksi = acak2(4);
    $enc_password = md5($unik_password);

    $id = $_POST['id'];
    $userid = $_POST['userid'];
    $name = $_POST['name'];
    $hphone = $_POST['hphone'];
    $email = $_POST['email'];
    $ktp = $_POST['ktp'];
    $address = $_POST['address'];
    $kecamatan = $_POST['kecamatan'];
    $kota = $_POST['kota'];
    $propinsi = $_POST['propinsi'];
    $kode_pos = $_POST['kode_pos'];
    $country = $_POST['country'];
    $bank = $_POST['bank'];
    $rekening = $_POST['rekening'];
    $atasnama = $_POST['atasnama'];
    $username = $row['userid'];
    $upline = $_POST['upline'];

    $g2 = $row['sponsor'];
    $g3 = $row['g2'];
    $g4 = $row['g3'];
    $g5 = $row['g4'];
    $g6 = $row['g5'];
    $g7 = $row['g6'];
    $g8 = $row['g7'];
    $g9 = $row['g8'];
    $g10 = $row['g9'];

    // msg
    $msg = "";
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
        // UPLOAD FOTO KTP
        $ekstensi_diperbolehkan    = array('PNG', 'JPG', 'JPEG','png', 'jpg', 'jpeg');
        $nama = $_FILES['fotoktp']['name'];
        $temp = explode('.', $nama);
        $ekstensi = strtolower(end($temp));
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $ukuran    = $_FILES['fotoktp']['size'];
        $file_tmp = $_FILES['fotoktp']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, 'img/foto-ktp/' . $newfilename);
                $fotoktp = 'img/foto-ktp/' . $newfilename;
            } else {
                echo '<script type="text/javascript">alert("UKURAN FILE TERLALU BESAR");</script>';
            }
        } else {
            echo '<script type="text/javascript>alert("EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN");</script>';
        }

        $insert = mysqli_query($koneksi, "INSERT INTO mebers 
(sponsor, upline, g2, g3, g4, g5, g6, g7, g8, g9, g10, userid, name, hphone, email, fotoktp, ktp, address, kecamatan, kota, propinsi, kode_pos, country, bank, rekening, atasnama, passw, timer)
VALUES
('$username', '$upline', '$g2', '$g3', '$g4', '$g5', '$g6', '$g7', '$g8', '$g9', '$g10', '$userid', '$name', '$hphone', '$email', '$fotoktp', '$ktp', '$address', '$kecamatan', '$kota', '$propinsi', '$kode_pos', '$country', '$bank', '$rekening', '$atasnama', '$unik_password', now())") or die(mysqli_error());

        //Kirim Email

        $newuser_msg = " 
$name, welcome to TomboAtiTour.com

Your Account :
Username  : $username
Password : $unik_password
Transaction Password : $unik_transaksi
Email : $email
Mobile Phone  : $hp

Login to member area :
http://TomboAtiTour.com/dashboard/login.php.

----------------------------
Webmaster
TomboAtiTour.com
admin@TomboAtiTour.com

";

        $admin_varian = "admin@TomboAtiTour.com";
        $admin_em = "TomboAtiTour.com <admin@TomboAtiTour.com>";
        $pastitle = "Welcome to TomboAtiTour.com";
        $pastitle2 = "New Member TomboAtiTour.com";

        $headers = "From: $admin_em\r\n";
        $headers .= "Reply-To: $admin_em\r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        //           mail($email, $pastitle, $newuser_msg, $headers);
        //            mail($admin_varian, $pastitle2, $newuser_msg, $headers);



        header("Location: register.php?error=SUCCESS");
    }
}

if ($sum_register > 0) {
    $status = '<button class="btn btn-success" name="button" type="submit">Next</button>';
} else {
    $status = '<a href="point-add"><button class="btn btn-success">Saldo Point Register Tidak Cukup</button></a>';
}

?>
</div>
</div>
</div>
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>Register Mitra</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index"><i class="ik ik-home"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Permintaan Mitra</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Form Register</a>
                        </li>
                    </ul>
                    <!-- Permintaan -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                            <div class="card-body p-0 table-border-style">
                                <div class="card-body ">
                                    <?php
                                    $query1 = "select * from mebers where sponsor ='$username' AND paket = 'MITRA' AND upline=''";
                                    $tampil = mysqli_query($koneksi, $query1) or die(mysqli_error());
                                    ?>

                                    <table class="table" border="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>No. </center>
                                                </th>
                                                <th>
                                                    <center>Tanggal </i></center>
                                                </th>
                                                <th>
                                                    <center>Username </i></center>
                                                </th>
                                                <th>
                                                    <center>Nama Jamaah </i></center>
                                                </th>
                                                <th>
                                                    <center>Peserta</center>
                                                </th>
                                                <th>
                                                    <center>Kota </i></center>
                                                </th>
                                                <th>
                                                    <center>ID Link </i></center>
                                                </th>
                                                <th>
                                                    <center>Contact </center>
                                                </th>
                                                <th>
                                                    <center>Aksi</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $no = 0;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                            $no++;
                                        ?>

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <right><?php echo $no; ?>.</center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $data['timer']; ?></center>
                                                    </td>
                                                    <td>
                                                        <left>
                                                            <a href="JavaScript:newPopup('<?php echo $data[photo]; ?>');"><img src="<?php echo $data[photo]; ?>" class="img-circle" alt="User Image" style="border: 2px solid #3C8DBC;" width="50" height="50" /></a> <?php echo $data['userid']; ?>
                                                        </left>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $data['name']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $data['paket']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $data['kota']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $data['upline']; ?></center>
                                                    </td>
                                                    <td>
                                                        <right><?php echo $data['hphone']; ?><br><?php echo $data['right']; ?></right>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <button class="btn btn-info" name="register-detail" type="button" data-toggle="modal" data-target="#detail-registerModal">Detail</button>
                                                            <button class="btn btn-warning" name="register-edit" type="button" data-toggle="modal" data-target="#edit-registerModal<?php echo $data['id']; ?>">Edit</a>
                                                        </center>
                                                    </td>
                                                </tr>

                                                <!-- Modal Detail -->
                                                <div class="modal fade" id="detail-registerModal" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Detail Data</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-4">Username</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['userid']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Nama</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['name']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Nomor HP</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['hphone']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Email</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['email']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">KTP</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['ktp']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Alamat</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['address']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Kecamatan</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['kecamatan']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Kota / Kabupaten</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['kota']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Provinsi</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['propinsi']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Kode Pos</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['kode_pos']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Negara</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['country']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Bank</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['bank']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Rekening</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['rekening']; ?></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">Account Name</div>
                                                                    <div class="col-6 text-left text-bold"><?php echo $data['atasnama']; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                                <!-- Modal Detail -->
                                                <div class="modal fade" id="edit-registerModal<?php echo $data['id']; ?>" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Data</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form method="post" action="register-edit.php">
                                                                <div class="modal-body">
                                                                    Memberikan ID Link untuk :
                                                                    <div class="row">
                                                                        <div class="col-4">Nama</div>
                                                                        <div class="col-6 text-left text-bold"><?php echo $data['name']; ?></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">Nomor HP</div>
                                                                        <div class="col-6 text-left text-bold"><?php echo $data['hphone']; ?></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">KTP</div>
                                                                        <div class="col-6 text-left text-bold"><?php echo $data['ktp']; ?></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">Email</div>
                                                                        <div class="col-6 text-left text-bold"><?php echo $data['email']; ?></div>
                                                                    </div>
                                                                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                                                    <div class="row">
                                                                        <div class="col-4">ID Link</div>
                                                                        <div class="col-6 text-left text-bold"><input name="upline" type="text" class="form-control" placeholder="ID Link" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-warning" name="btn-register-edit" type="submit">Edit</a>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            <?php
                                        }
                                            ?>

                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="state">
                                    <h6>Poin Register</h6>
                                    <h2><?php echo number_format($sum_register, 0, ',', '.'); ?></h2>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="forms-sample" action="register.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Freelance</label>
                                                <div class="col-sm-9">
                                                    <input name="userid" type="text" class="form-control" id="exampleInputUsername2" value="<?php echo $row['userid']; ?>" readonly />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ID Link<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="upline" type="text" class="form-control" id="exampleInputUsername2" placeholder="ID Link" value="<?php echo $_GET['upline']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Username<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="userid" type="text" class="form-control" id="exampleInputUsername2" placeholder="Username" value="<?php echo $_GET['userid']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="name" type="text" class="form-control" id="exampleInputUsername2" placeholder="name" value="<?php echo $_GET['name']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">HP<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="hphone" type="text" class="form-control" id="exampleInputUsername2" placeholder="hphone" value="<?php echo $_GET['hphone']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="email" type="email" class="form-control" id="exampleInputUsername2" placeholder="email" value="<?php echo $_GET['email']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">KTP<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="ktp" type="number" class="form-control" id="exampleInputUsername2" placeholder="nik" value="<?php echo $_GET['ktp']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="foto-KTP" class="col-sm-3 col-form-label">Foto KTP<br><small>Maksimal 5 MB</small><span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="fotoktp" type="file" class="form-control-file" id="foto-KTP" value="<?php echo $_GET['fotoktp']; ?>" required />
                                                    <small> Format : .jpg .jpeg .png </small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Alamat<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="address" type="text" class="form-control" id="exampleInputUsername2" placeholder="Alamat" value="<?php echo $_GET['address']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Kecamatan<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="kecamatan" type="text" class="form-control" id="exampleInputUsername2" placeholder="Kecamatan" value="<?php echo $_GET['kecamatan']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Kota<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="kota" type="text" class="form-control" id="exampleInputUsername2" placeholder="Kota" value="<?php echo $_GET['kota']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Propinsi<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="propinsi" type="text" class="form-control" id="exampleInputUsername2" placeholder="Propinsi" value="<?php echo $_GET['propinsi']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Kodepos<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="kode_pos" type="number" class="form-control" id="exampleInputUsername2" placeholder="Kodepos" value="<?php echo $_GET['kode_pos']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Negara<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input name="country" type="text" class="form-control" id="exampleInputUsername2" placeholder="Negara" value="<?php echo $_GET['country']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Bank</label>
                                                <div class="col-sm-9">
                                                    <input name="bank" type="text" class="form-control" id="exampleInputUsername2" placeholder="Bank" value="<?php echo $_GET['bank']; ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Rekening</label>
                                                <div class="col-sm-9">
                                                    <input name="rekening" type="text" class="form-control" id="exampleInputUsername2" placeholder="Account" value="<?php echo $_GET['rekening']; ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Account Name</label>
                                                <div class="col-sm-9">
                                                    <input name="atasnama" type="text" class="form-control" id="exampleInputUsername2" placeholder="Account Name" value="<?php echo $_GET['atasnama']; ?>" />
                                                </div>
                                            </div>
                                            <?php echo $status; ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="col-md-6">
                                <form class="forms-sample" action="" method="post">
                                    <div class="form-group row">
                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input name="userid" type="text" class="form-control" id="exampleInputUsername2" placeholder="Username" value="<?php echo $row['userid']; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Password Baru</label>
                                        <div class="col-sm-9">
                                            <input name="userid" type="text" class="form-control" id="exampleInputUsername2" placeholder="Username" value="<?php echo $row['userid']; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Password Lama</label>
                                        <div class="col-sm-9">
                                            <input name="userid" type="text" class="form-control" id="exampleInputUsername2" placeholder="Username" value="<?php echo $row['userid']; ?>" />
                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="submit">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<?php
include 'footer.php';
?>