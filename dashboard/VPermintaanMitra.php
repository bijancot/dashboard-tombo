<?php
session_start();
include 'header.php';
include 'config2.php';
?>

<head>
    <title>Tombo Ati | Permintaan Mitra</title>
    <!-- <link rel="stylesheet" href="modalstyle.css"> -->
</head>


<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user m-r-5"></i> Permintaan Mitra[<a href="excel/export_excel_members.php">Export to Excel</a>]</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <?php
                            if (isset($_GET['username-src'])) {
                                $username_src = $_GET['src1'];
                            }

                            //index awal data yang ingin ditampilkan
                            $default_index = 0;

                            //batasan menampilkan data
                            $default_batas = 20;

                            //jika terdapat nilai batas di URL, gunakan untuk mengganti nilai default $default_batas
                            if (isset($_GET['batas'])) {
                                $default_batas = $_GET['batas'];
                            }

                            //jika terdapat nilai halaman di URL, gunakan untuk mengganti nilai dafault dari $default_index
                            if (isset($_GET['halaman'])) {
                                $default_index = ($_GET['halaman'] - 1) * $default_batas;
                            }

                            //update notif
                            mysqli_query($koneksi, "UPDATE mebers SET is_seen_notifikasi='1' WHERE paket='BARU'");
                
                            $query1 = "SELECT * FROM mebers WHERE paket='BARU' ORDER BY timer DESC limit $default_index, $default_batas";
                            $tampil = mysqli_query($koneksi, $query1) or die(mysqli_error());
                            $total_baris = mysqli_num_rows($tampil);


                            ?>
                            <form action="VSearchPermintaanMitra.php" method="get">
                                <label></label>
                                <input type="text" name="cari">
                                <input type="submit" value="Search">
                            </form>

                            <?php
                            if (isset($_GET['output'])) {
                                $output = $_GET['output'];
                            } else {
                                $output = "";
                            }

                            //siapkan pesan kesalahan
                            $pesan = "";
                            if ($output == "berhasil") {
                                $pesan = '<div class="alert alert-success m-t-10 alert-dismissible fade in " id ="flash-msg" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                <strong> Berhasil !</strong>
                                <br>
                                Verifikasi Permintaan Mitra.
                                </div>';
                            }
                            ?>
                            <?php
                            echo $pesan;
                            ?>
                            <table id="example" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>No. </center>
                                        </th>
                                        <th>
                                            <center>Username</center>
                                        </th>
                                        <th>
                                            <center>Email</center>
                                        </th>
                                        <th>
                                            <center>Nomor HP</center>
                                        </th>
                                        <th>
                                            <center>Referral </center>
                                        </th>
                                        <th>
                                            <center>Register Date </center>
                                        </th>
                                        <th width="17%">
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <!-- <?php
                                        $no = 0;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                            $no++;

                                            $sqlsponsor = mysqli_query($koneksi, "SELECT * FROM mebers WHERE userid = '$data[sponsor]' ");
                                            $rowsponsor = mysqli_fetch_assoc($sqlsponsor);
                                            $sqlupline = mysqli_query($koneksi, "SELECT * FROM mebers WHERE userid = '$data[upline]' ");
                                            $rowupline = mysqli_fetch_assoc($sqlupline);
                                        ?> -->
                                <tbody>
                                    <tr>
                                        <td>
                                            <center><?php echo $no; ?>.</center>
                                        </td>
                                        <td>
                                            <left>
                                                <font color="blue"><b><?php echo $data['userid']; ?></b>
                                            </left>
                                        </td>
                                        <td>
                                            <left>
                                                <font color="blue"><b><?php echo $data['email']; ?></b>
                                            </left>
                                        </td>
                                        <td>
                                            <left>
                                                <font color="blue"><b><?php echo $data['hphone']; ?></b>
                                            </left>
                                        </td>
                                        <td>
                                            <left>
                                                <font color="blue"><b><?php echo $data['sponsor']; ?></font><br><?php echo $rowsponsor['name']; ?></center>
                                        </td>
                                        <td>
                                            <center>
                                                <font color="blue"><b><?php echo $data['timer']; ?></b></font>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <!-- <a href="admin-profile-edit.php?userid=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-check m-r-4"></i>Verifikasi</a> -->
                                                <a href='#modalVerif<?= $data['id'] ?>' class='btn btn-primary btn-sm m-l-5 m-t-5' data-toggle='modal'><i class='fa fa-check m-r-5'></i>Verifikasi</a>
                                                <?php echo "<a href='#myModal' class='btn btn-info btn-sm m-l-5 m-t-5' id='myBtn' data-toggle='modal' data-id=" . $data['id'] . "><i class='fa fa-eye m-r-5'></i>Detail</a>"; ?>
                                            </center>

                                        </td>
                                    </tr>
                        </div>

                        <!-- modal verifikasi -->
                        <div class="modal fade" id="modalVerif<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="exampleModalLabel">Verifikasi Permintaan Mitra</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p> Apakah anda yakin ingin memverifikasi permintaan mitra dengan username <b> <?php echo $data['userid']; ?></b> ?</p>
                                    </div>
                                    <div class="modal-footer m-b-10">
                                        <form action="verifMitra.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                            <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
                                            <input type="hidden" name="name" value="<?php echo $data['name']; ?>">
                                            <input type="hidden" name="userid" value="<?php echo $data['userid']; ?>">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check m-r-4"></i>Verifikasi</button>
                                        </form>
                                        <button type="button" class="btn btn-danger m-b-10" data-dismiss="modal"><i class="fa fa-times m-r-4"></i>Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal  -->
                        <!-- modal detail  -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModal">Detail Permintaan Mitra</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="fetched-data"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary m-b-10" data-dismiss="modal"><i class="fa fa-times m-r-4"></i>Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal  -->
                        <!-- <?php
                                            $html_paging = "<li><a href='?halaman=" . $nomor_paging . "&batas=" . $default_batas . "'>" . $nomor_paging . "</a></li>";
                                        }


                                ?> -->
                        </tbody>
                        </table>

                        <form method="get">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <input class="form-control" name="batas" value='<?php echo $default_batas ?>' />
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-default btn-block" type="submit">BARIS</button>
                                </div>
                            </div>
                        </form>
                        <center>

                            <?php

                            $halaman = @$_GET['halaman'];
                            if (empty($halaman)) {
                                $posisi  = 0;
                                $halaman = 1;
                            } else {
                                $posisi  = ($halaman - 1) * $default_batas;
                            }



                            $query2 = mysqli_query($koneksi, "select * from mebers WHERE paket='BARU'");
                            $jmldata = mysqli_num_rows($query2);
                            $jmlhalaman = ceil($jmldata / $default_batas);
                            $hal1 = $_GET['halaman'] - 1;
                            $hal2 = $_GET['halaman'] + 1;
                            if ($batas != '') {
                                $batas2 = $_GET['batas'];
                            } else {
                                $batas2 = $default_batas;
                            }
                            echo " 
<ul class=\"pagination\">
<li class=\"page-item\"><a href=\"VPermintaanMitra.php?halaman=$hal1&batas=$batas2\">Previous</a></li>
</ul>";

                            for ($i = 1; $i <= $jmlhalaman; $i++)


                                if ($i != $halaman) {

                                    echo " 
<ul class=\"pagination\">
<li class=\"page-item\"><a href=\"VPermintaanMitra.php?halaman=$i&batas=$batas2\">$i</a></li>
</ul>";
                                } else {
                                    echo " <ul class=\"pagination\"><li class=\"page-item active\"><a href=\"VPermintaanMitra.php?halaman=$i&batas=$batas2\">$i</a></li></ul>";
                                }
                            echo " 
<ul class=\"pagination\">
<li class=\"page-item\"><a href=\"VPermintaanMitra.php?halaman=$hal2&batas=$batas2\">Next</a></li>
</ul>";

                            echo "<p>Total Record : <b>$jmldata</b> Member</p>";
                            ?>
                            <!-- </div>-->
                    </div>
                </div>
            </div><!-- col-lg-12-->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#myModal').on('show.bs.modal', function(e) {
                        var rowid = $(e.relatedTarget).data('id');
                        $.ajax({
                            type: 'post',
                            url: 'detailPermintaanMitra.php',
                            data: 'rowid=' + rowid,
                            success: function(data) {
                                $('.fetched-data').html(data);
                            }
                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    $("#flash-msg").delay(5000).fadeOut("slow");
                });
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

            <?php include 'footer.php'; ?>