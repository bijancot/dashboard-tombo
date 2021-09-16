<?php
//Timer setting
        $timer=gmdate("Y-m-d H:i:s", gmmktime(gmdate("H")+$conf['mytime']));
        $today=gmdate("Y-m-d", gmmktime(gmdate("H")+$conf['mytime']));
        $tgl_bln_thn=gmdate("d-m-Y", gmmktime(gmdate("H")+$conf['mytime']));
        $yearmd=gmdate("Y-m-d", gmmktime(gmdate("H")+$conf['mytime']));
        $tanggal=gmdate("d", gmmktime(gmdate("H")+$conf['mytime']));
        $bulan=gmdate("m", gmmktime(gmdate("H")+$conf['mytime']));
        $tahun=gmdate("Y", gmmktime(gmdate("H")+$conf['mytime']));
        $jam=gmdate("H", gmmktime(gmdate("H")+$conf['mytime']));
        $menit=gmdate("i", gmmktime(gmdate("H")+$conf['mytime']));
        // $prevnn = mktime(0, 0, 0, date("m") - 1, date("d"), date("Y"));
        $prevm = gmmktime(0, 0, 0, gmdate("m", gmmktime(gmdate("H")+$conf['mytime']))-1, gmdate("d", gmmktime(gmdate("H")+$conf['mytime'])), gmdate("Y", gmmktime(gmdate("H")+$conf['mytime'])));
        $prevmonth=gmdate("m", $prevm); 
        $prevyear=gmdate("Y", $prevm);

session_start();
include 'header.php';
?>

<head>
  <title>Tombo Ati | Pin Order</title>
</head>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                <section class="content">

           <!-- /.row -->
                    <br />
                    <!-- Main row -->
                    <?php
            $query = mysqli_query($koneksi, "SELECT * FROM ticket WHERE userid='$row[username]'");
            $data  = mysqli_fetch_array($query);
            ?>



<!-- col-lg-12--> 



                    <div class="row">
                        <div class="col-lg-12">
                        <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-book"></i> Order Pin Aktivasi</h3> 
                        </div>
                        <div class="panel-body">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" action="pin-order2.php" method="post" name="form1" id="form1">
                                  <input name="id" type="hidden" id="id" class="form-control" value="<?php echo $_SESSION[id];?>" readonly="readonly" autofocus="on" />
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Username</label>
                              <div class="col-sm-10">
                                  <input name="userid" type="text" id="bank" class="form-control" value="<?php echo $row['userid'];?>" readonly />
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Jumlah Pin</label>
                              <div class="col-sm-10">

<input name="jumlahpin" type="number" id="jumlahpin" value="" class="form-control" required>

                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Membership Package</label>
                              <div class="col-sm-10">

<select name="paket" required>
<option value="">-----------------</option>
<option value="SILVER">Silver (Rp.5.000.000)</option>
<option value="GOLD">Gold (Rp.15.000.000)</option>
<option value="PLATINUM">Platinum (Rp.35.000.000)</option>
<option value="">-----------------</option>
<option value="UPGRADE SILVER TO GOLD">Upgrade Silver to Gold (Rp.10.000.000)</option>
<option value="UPGRADE SILVER TO PLATINUM">Upgrade Silver to Platinum (Rp.30.000.000)</option>
<option value="UPGRADE GOLD TO PLATINUM">Upgrade Gold to Platinum (Rp.20.000.000)</option>
<option value="">-----------------</option>
</select>

                              </div>
                          </div>



                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
                              <div class="col-sm-10">
                                  <input name="tangggal" class="form-control" id="atas_nama" type="text" value="<?php echo $timer;?>" readonly />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" name="pin-order" value="Next"  class="btn btn-sm btn-primary"/>&nbsp;
	                              <a href="index.php" class="btn btn-sm btn-danger">Batal </a>
                              </div>
                          </div>
                      </form>
                  </div>
                  </div>
                  </div>







          		</div>

<?php include 'footer.php'; ?>