<?php
session_start();
include 'header.php';
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Pin Aktivasi
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                    

              </div>
           <!-- /.row -->
                    <br />
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Pin List [<a href="excel/export_excel_pin.php">Export to Excel</a>]</h3> 
                        </div>
                        <div class="panel-body">
                       <!-- <div class="table-responsive"> -->

<?php
if(isset($_GET['username-src']))
{    $username_src = $_GET['src1'];
}

//index awal data yang ingin ditampilkan
$default_index = 0;

//batasan menampilkan data
$default_batas = 20;

//jika terdapat nilai batas di URL, gunakan untuk mengganti nilai default $default_batas
if(isset($_GET['batas']))
{
    $default_batas = $_GET['batas'];
}

//jika terdapat nilai halaman di URL, gunakan untuk mengganti nilai dafault dari $default_index
if(isset($_GET['halaman']))
{
    $default_index = ($_GET['halaman']-1) * $default_batas;
}

    $query1 = "SELECT * FROM pin ORDER BY id DESC limit $default_index, $default_batas";
    $tampil = mysqli_query($koneksi, $query1) or die(mysqli_error());
    $total_baris = mysqli_num_rows($tampil);


?>

                  <table id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                        <th><center>No. </center></th>
                        <th><center>Username</center></th>
                        <th><center>Pin Aktivasi</center></th>
                        <th><center>Membership</center></th>
                        <th><center>Usedid</center></th>
                        <th><center>Nama</center></th>
                        <th><center>Add Time</center></th>
                        <th><center>Used Time</center></th>
                        <th><center>Used </center></th>
                        <th><center>Status </center></th>
                      </tr>
                  </thead>


                     <?php 


                     $no=0;
                     while($data=mysqli_fetch_array($tampil))
                    { $no++; 

$data_timer = mysqli_query($koneksi, "SELECT * FROM mebers WHERE userid = '$data[userid]' ");
$row_timer = mysqli_fetch_assoc($data_timer);

?>
                    <tbody>


                    <tr>
                    <td><left><?php echo $no; ?>.</left></td>
                    <td><left><?php echo $data['pinfor'];?></left></td>
                    <td><left><?php echo $data['pin'];?></left></td>
                    <td><left><?php echo $data['paket'];?></left></td>
                    <td><left><?php echo $data['userid'];?></left></td>
                    <td><left><?php echo $row_timer['name'];?></left></td>
                    <td><center><?php echo $data['tgladd'];?></center></td>
                    <td><center><?php echo $data['tanggal'];?></center></td>

<?
                            if ($data['used'] == '0'){
								$statusnya='<span class="label label-warning">Free</span>';
							}
                            else if ($data['used'] == '1' ){
								$statusnya='<span class="label label-success">Used</span>';
							}

                            if ($data['status'] == '0'){
								$status_pin='<span class="label label-warning">Lock</span>';
							}
                            else if ($data['status'] == '1' ){
								$status_pin='<span class="label label-success">Active</span>';
							}
?>


                    <td><center><?php echo $statusnya; ?></center></td>
                    <td><center><?php echo $status_pin; ?></center></td>
                    </tr>
</div>
                 <?php   
    $html_paging = "<li><a href='?halaman=".$nomor_paging."&batas=".$default_batas."'>".$nomor_paging."</a></li>";

              } 

  
              ?>
                   </tbody>
                   </table>

            <form method="get">
              <div class="form-group row">
                <div  class="col-sm-3">
                  <input  class="form-control" name="batas" value='<?php echo $default_batas?>'/>
                </div>
                <div class="col-md-3">
                  <button class="btn btn-default btn-block" type="submit">BARIS</button>
                </div>
              </div>
            </form>
<center>


<?php

$halaman = @$_GET['halaman'];
if(empty($halaman)){
 $posisi  = 0;
 $halaman = 1;
}
else{ 
  $posisi  = ($halaman-1) * $default_batas; 
}



$query2 = mysqli_query($koneksi, "select * from pin");
$jmldata = mysqli_num_rows($query2);
$jmlhalaman = ceil($jmldata/$default_batas);
$hal1 = $_GET['halaman']-1;
$hal2 = $_GET['halaman']+1;
if ($batas!='') {$batas2 = $_GET['batas'];} else {$batas2 = $default_batas;}
 echo " 
<ul class=\"pagination\">
<li class=\"page-item\"><a href=\"admin-pin.php?halaman=$hal1&batas=$batas2\">Previous</a></li>
</ul>";

for($i=1;$i<=$jmlhalaman;$i++)


if ($i != $halaman){

 echo " 
<ul class=\"pagination\">
<li class=\"page-item\"><a href=\"admin-pin.php?halaman=$i&batas=$batas2\">$i</a></li>
</ul>";
}
else{ 
 echo " <ul class=\"pagination\"><li class=\"page-item active\"><a href=\"admin-pin.php?halaman=$i&batas=$batas2\">$i</a></li></ul>"; 
}
 echo " 
<ul class=\"pagination\">
<li class=\"page-item\"><a href=\"admin-pin.php?halaman=$hal2&batas=$batas2\">Next</a></li>
</ul>";

echo "<p>Total Record : <b>$jmldata</b> Mitra</p>";
echo "<p><a href=\"excel/export_excel_pin.php\"><b><h3>Export to Excel</a></b></h3></p>";
?>
                  <!-- </div>-->
              </div> 
              </div>
            </div><!-- col-lg-12--> 
<?php include 'footer.php'; ?>