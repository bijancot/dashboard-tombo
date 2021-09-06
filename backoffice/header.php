 <?php
include('config.php');
include('fungsi.php');
ini_set('display_errors','off');
session_start();

if(cek_login($mysqli) == false){
echo "<script type='text/javascript'>document.location.href = 'logout';</script>";
	exit();	
}

$stmt = $mysqli->prepare("SELECT userid FROM mebers WHERE id = ?");
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($username);
$stmt->fetch();

$sql = mysqli_query($koneksi, "SELECT * FROM mebers WHERE id = '$_SESSION[id]' ");
$row = mysqli_fetch_assoc($sql);
$ref = $row['ref'];
$username = $row['userid'];
$name = $row['name'];
$email = $row['email'];
$id = $row['id'];
$file_idcard = $row['photo_idcard'];
$file_kk = $row['photo_kk'];
$data_idcard = $row['idcard'];
$data_kk = $row['evocash_account'];

$res_deposit = mysqli_query($koneksi,"SELECT sum(amount) FROM hm2_pending_deposits WHERE user_id='$row[id]' AND status='processed' ");
$rowsum_deposit = mysqli_fetch_row($res_deposit);
$sum_deposit = $rowsum_deposit[0];

$query_total = mysqli_query($koneksi,"SELECT SUM(bonus) as 'bonus_total_sponsor' FROM bonus_sponsor WHERE userid='$row[userid]' ");
$query_total2=mysqli_fetch_array($query_total);
$bonus_sponsor_total=$query_total2['bonus_total_sponsor'];

$query_titik = mysqli_query($koneksi,"SELECT SUM(bonus) as 'bonus_total_titik' FROM bonus_titik WHERE userid='$row[userid]' ");
$querytitik=mysqli_fetch_array($query_titik);
$bonus_titik_total=$querytitik['bonus_total_titik'];

$query_point = mysqli_query($koneksi,"SELECT SUM(point) as 'bonus_total_point' FROM bonus_titik WHERE userid='$row[userid]' ");
$querypoint=mysqli_fetch_array($query_point);
$bonus_point_total=$querypoint['bonus_total_point'];

$query_point = mysqli_query($koneksi,"SELECT SUM(jumlah) as 'total_point' FROM hm2_pending_deposits WHERE status='processed' AND type='point' AND user_id='$row[id]' ");
$query_total2=mysqli_fetch_array($query_point);
$point_total=$query_total2['total_point'];

$query_wd = mysqli_query($koneksi,"SELECT SUM(amount) as 'total_wd' FROM hm2_history WHERE user_id='$row[id]' ");
$query_wd2=mysqli_fetch_array($query_wd);
$wd_total=$query_wd2['total_wd'];

$tampil_ref=mysqli_query($koneksi, "select * from mebers where sponsor='$row[userid]' ");
$total_ref=mysqli_num_rows($tampil_ref);

$tampil_ref_reseller=mysqli_query($koneksi, "select * from mebers where sponsor='$row[userid]' AND paket='RESELLER'");
$total_ref_reseller=mysqli_num_rows($tampil_ref_reseller);


$sum=$bonus_sponsor_total+$bonus_titik_total-$wd_total;
$sum_register=$point_total-$total_ref;

date_default_timezone_set('Asia/Jakarta')

?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>TomboAtiTour.com - Dashboard</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="plugins/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="plugins/c3/c3.min.css">
        <link rel="stylesheet" href="plugins/owl.carousel/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="dist/css/theme.min.css">
        <script src="src/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="wrapper">
           <header class="header-top" header-theme="light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <div class="top-menu d-flex align-items-center">
                            <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                            <div class="header-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                                </div>
                            </div>
                            <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                        </div>
                        <div class="top-menu d-flex align-items-center">
                            <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal" data-target="#appsModal"><i class="ik ik-grid"></i></button>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="<?php echo $row['photo']; ?>" alt=""></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="profile"><i class="ik ik-user dropdown-icon"></i> Profile</a>
                                    <a class="dropdown-item" href="logout"><i class="ik ik-power dropdown-icon"></i> Logout</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>
            <div class="page-wrap">
                <div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="index">
                            <span class="text"><img src="https://lifeforwin.co.id/assets/images/logo.png" width="70%" class="header-brand-img" alt="<?php include "$username"; ?>"></span>
                        </a>
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>
                    
                    <div class="sidebar-content">
                        <div class="nav-container">

<?php
IF ($username=='company') {$menu='
                                <div class="nav-item active">
                                    <a href="../dashboard/index"><i class="ik ik-bar-chart-2"></i><span>Admin Area</span></a>
                                </div>
';} 
?>                    
                            <nav id="main-menu-navigation" class="navigation-main">
                                <div class="nav-lavel">Navigation</div>
                                    <?php echo "$menu"; ?>

                                <div class="nav-item active">
                                    <a href="index"><i class="ik ik-monitor"></i><span>Dashboard</span></a>
                                </div>
                                <div class="nav-item">
                                    <a href="profile"><i class="ik ik-user-check"></i><span>Profile</span></a>
                                </div>
                                <div class="nav-lavel">Freelance</div>

                                <div class="nav-item">
                                    <a href="register"><i class="ik ik-users"></i><span>Register Member</span></a>
                                </div>
                                <div class="nav-item">
                                    <a href="direct-member"><i class="ik ik-users"></i><span>Referensi Jamaah</span></a>
                                </div>


                                <div class="nav-lavel">Royalty</div>
                                <div class="nav-item has-sub">
                                    <a href="#"><i class="ik ik-box"></i><span>Fee & Free</span></a>
                                    <div class="submenu-content">
                                        <a href="fee-awal" class="menu-item">Fee Awal</a>
                                        <a href="fee-akhir" class="menu-item">Fee Akhir</a>
                                    </div>
                                </div>

                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Hadiah</span></a>
                                    <div class="submenu-content">
                                        <a href="hadiah-point" class="menu-item">Hadiah Poin</a>
                                        <a href="g2" class="menu-item">Hadiah Wisata</a>
                                    </div>
                                </div>

                                <div class="nav-lavel">Finansial</div>

                                <div class="nav-item has-sub">
                                    <a href="#"><i class="">Rp.</i><span>Topup</span></a>
                                    <div class="submenu-content">
                                        <a href="upgrade-process" class="menu-item">Topup</a>
                                        <a href="topup-history" class="menu-item">History</a>
                                    </div>
                                </div>

                                <div class="nav-item has-sub">
                                    <a href="#"><i class="">Rp.</i><span>Hak Register</span></a>
                                    <div class="submenu-content">
                                        <a href="point-add" class="menu-item">Order</a>
                                        <a href="point-history" class="menu-item">History</a>
                                    </div>
                                </div>

                                <div class="nav-item has-sub">
                                    <a href="#"><i class="">Rp.</i><span>Withdrawal</span></a>
                                    <div class="submenu-content">
                                        <a href="wd-request" class="menu-item">WD Request</a>
                                        <a href="wd-history" class="menu-item">History</a>
                                    </div>
                                </div>

                                <div class="nav-lavel">Security</div>
                                <div class="nav-item">
                                    <a href="logout"><i class="ik ik-lock"></i><span>Logout</span></a>
                                </div>

                            </nav>