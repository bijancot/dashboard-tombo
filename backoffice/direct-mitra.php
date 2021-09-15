<?php
session_start();
include 'header.php';
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
                                        <i class="ik ik-credit-card bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Referensi Jamaah</h5>
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


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-block">
                                        <h3>Referensi Langsung</h3>
                                    </div>
                                    <div class="card-body p-0 table-border-style">
                                        <div class="table-responsive">
                    <?php
                    $query1="select * from mebers where sponsor='$row[userid]' && upline != ''";
                    
                    if(isset($_POST['qcari'])){
	                $qcari=$_POST['qcari'];
	                $query1="SELECT * FROM  bank 
	                where nama_bank like '%$qcari%'
	                or nasabah like '%$qcari%'  ";
                    }
                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    ?>

                                            <table class="table" border="0">
                                                <thead>
                                                    <tr>
                        <th><center>No. </center></th>
                        <th><center>Tanggal </i></center></th>
                        <th><center>Username </i></center></th>
                        <th><center>Nama Jamaah </i></center></th>
                        <th><center>Peserta</center></th>
                        <th><center>Kota </i></center></th>
                        <th><center>ID Link </i></center></th>
                        <th><center>Contact </center></th>
                                                    </tr>
                                                </thead>
                     <?php 
                     $no=0;
                     while($data=mysqli_fetch_array($tampil))
                    { $no++; ?>

                                                <tbody>
                                                    <tr>
                    <td><right><?php echo $no; ?>.</center></td>
                    <td><center><?php echo $data['timer'];?></center></td>
                    <td><left>
<a href="JavaScript:newPopup('<?php echo $data[photo]; ?>');"><img src="<?php echo $data[photo]; ?>" class="img-circle" alt="User Image" style="border: 2px solid #3C8DBC;" width="50"  height="50" /></a> <?php echo $data['userid'];?></left></td>
                    <td><center><?php echo $data['name'];?></center></td>
                    <td><center><?php echo $data['paket'];?></center></td>
                    <td><center><?php echo $data['kota']; ?></center></td>
                    <td><center><?php echo $data['upline']; ?></center></td>
                    <td><right><?php echo $data['hphone']; ?><br><?php echo $data['right']; ?></center></td>
                                                    </tr>
                 <?php   
              } 
              ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
        
        
<?php
include 'footer.php';
?>