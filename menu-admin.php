 <?php
$userid = $row['userid'];
if ($userid!="company") {
header("Location: ../dashboard/logout.php");
} 
?>
                    <br />
                    <ul class="sidebar-menu">
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>User</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="admin-all-member-on"><i class="fa fa-angle-double-right"></i> Members</a></li>
                            </ul>
                        </li>



                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Bonus Record</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="admin-bonus-sponsor"><i class="fa fa-angle-double-right"></i> Fee Awal</a></li>
                               <li><a href="admin-bonus-akhir"><i class="fa fa-angle-double-right"></i> Fee Akhir</a></li>
                               <li><a href="admin-bonus-upline"><i class="fa fa-angle-double-right"></i> Hadiah Poin</a></li>
                            </ul>
                        </li>




                       <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Topup</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="admin-all-deposit-new"><i class="fa fa-angle-double-right"></i> Topup New</a></li>
                               <li><a href="admin-all-deposit-processed"><i class="fa fa-angle-double-right"></i> Topup Processed</a></li>
                            </ul>
                        </li>


                       <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Hak Register</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="admin-all-point-new"><i class="fa fa-angle-double-right"></i> HR New</a></li>
                               <li><a href="admin-all-point-processed"><i class="fa fa-angle-double-right"></i> HR Processed</a></li>
                            </ul>
                        </li>

                       <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Withdrawal</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="admin-withdrawal-onprocess"><i class="fa fa-angle-double-right"></i> WD New</a></li>
                               <li><a href="admin-withdrawal-processed"><i class="fa fa-angle-double-right"></i> WD Processed</a></li>
                            </ul>
                        </li>


                        <li class="logout">
                            <a href="logout">
                                <i class="fa fa-money"></i> <span>Logout</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                        </li>


                    </ul>