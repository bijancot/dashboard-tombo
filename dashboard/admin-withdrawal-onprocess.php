<?php
session_start();
include 'header.php';
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Withdrawal On Proces
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
                        <h3 class="panel-title"><i class="fa fa-user"></i> Withdrawal Request</h3> 
                        </div>
                        <div class="panel-body">
                       <div class="table-responsive">
                    <?php
                    $query1="select * from hm2_history where type='withdraw_pending' ORDER BY id DESC";
                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    ?>
                  <table id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                        <th><center>No. </center></th>
                        <th><center>Username </i></center></th>
                        <th><center>Name </i></center></th>
                        <th><center>Amount </i></center></th>
                        <th><center>Description </center></th>
                        <th><center>Date </center></th>
                        <th><center>Status </center></th>
                     </tr>
                  </thead>
                     <?php 
                     $no=0;
                     while($data=mysqli_fetch_array($tampil))
                    { $no++; 

            $query_user = mysqli_query($koneksi, "SELECT * FROM mebers WHERE id='$data[user_id];'");
            $data_user  = mysqli_fetch_array($query_user);


?>
                    <tbody>
                    <tr>
                    <td><left><?php echo $no; ?>.</center></td>
                    <td><left><?php echo $data_user['userid']; ?></center></td>
                    <td><left><?php echo $data_user['name']; ?></center></td>
                    <td align="right"><?php echo $data['amount'];?></td>
                    <td><left><?php echo $data['description'];?></center></td>
                    <td><left><?php echo $data['date']; ?></center></td>
                     <td><center><a href="admin-update-wd-1.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-warning">Process <i class="fa fa-arrow-circle-right"></i></a></center></td>
                   </tr>
</div>
                 <?php   
              } 
              ?>
                   </tbody>
                   </table>
                  <!-- </div>-->
              </div> 
              </div>
            </div><!-- col-lg-12--> 
<?php include 'footer.php'; ?>