 <?php
$userid = $row['userid'];
if ($userid!="svarga") {
header("Location: ../backoffice/logout.php");
} 
?>
                    <br />
                    <ul class="sidebar-menu">
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Admin User</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="admin-all-member-on"><i class="fa fa-angle-double-right"></i> Members</a></li>
                               <li><a href="admin-ticket"><i class="fa fa-angle-double-right"></i> Ticket</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Admin Record</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="../wallet/admin-all-member-balance"><i class="fa fa-angle-double-right"></i> Member Transaction</a></li>
                               <li><a href="../wallet/admin-all-member-balance2"><i class="fa fa-angle-double-right"></i> Member Balance</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Admin Transaction</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="../wallet/admin-history-plan"><i class="fa fa-angle-double-right"></i> Order PIN</a></li>
                               <li><a href="../wallet/admin-report-all"><i class="fa fa-angle-double-right"></i> Report All</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Bonus Record</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="admin-bonus-sponsor"><i class="fa fa-angle-double-right"></i> Bonus Sponsor</a></li>
                               <li><a href="admin-bonus-pasangan"><i class="fa fa-angle-double-right"></i> Bonus Pasangan</a></li>
                               <li><a href="admin-bonus-leadership"><i class="fa fa-angle-double-right"></i> Bonus Leadership</a></li>
                            </ul>
                        </li>


                       <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>PIN Aktivasi</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="admin-pin"><i class="fa fa-angle-double-right"></i> PIN List</a></li>
                            </ul>
                        </li>


                       <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Repeat Order</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="admin-product-order-history"><i class="fa fa-angle-double-right"></i> RO On Process</a></li>
                               <li><a href="admin-product-order-history2"><i class="fa fa-angle-double-right"></i> RO Processed</a></li>
                               <li><a href="admin-product-order-history3"><i class="fa fa-angle-double-right"></i> RO New Order</a></li>
                               <li><a href="admin-product-list"><i class="fa fa-angle-double-right"></i> Product List</a></li>
                               <li><a href="admin-bonus-ro"><i class="fa fa-angle-double-right"></i> Bonus RO</a></li>
                            </ul>
                        </li>



                       <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Admin Deposit</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="../wallet/admin-all-deposit-new"><i class="fa fa-angle-double-right"></i> Deposit New</a></li>
                               <li><a href="../wallet/admin-all-deposit-processed"><i class="fa fa-angle-double-right"></i> Topup Deposit</a></li>
                               <li><a href="../wallet/admin-all-deposit-pending"><i class="fa fa-angle-double-right"></i> Deposit Pending</a></li>
                            </ul>
                        </li>


                       <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Admin Withdrawal</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="../wallet/admin-withdrawal-onprocess"><i class="fa fa-angle-double-right"></i> On Process</a></li>
                               <li><a href="../wallet/admin-withdrawal-processed"><i class="fa fa-angle-double-right"></i> Processed</a></li>
                            </ul>
                        </li>

                        <li class="logout">
                            <a href="../wallet/admin-setting">
                                <i class="fa fa-money"></i> <span>Admin Setting</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                        </li>


                    </ul>

                    <br />
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index">
                                <i class="glyphicon glyphicon-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>


                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon fa fa-user"></i> <span>Profile</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="profile"><i class="fa fa-angle-double-right"></i>Profile</a>
                                <li><a href="profile-edit"><i class="fa fa-angle-double-right"></i>Edit Profile</a>
                                <li><a href="profile-security"><i class="fa fa-angle-double-right"></i>Security</a>
                            </ul>
                        </li>

                        <li class="active">
                            <a href="direct-member">
                                <i class="glyphicon fa fa-users"></i> <span>Direct Member</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon fa fa-sitemap"></i>
                                <span>Genealogy</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="g1"><i class="fa fa-angle-double-right"></i> Generasi 1</a></li>
                               <li><a href="g2"><i class="fa fa-angle-double-right"></i> Generasi 2</a></li>
                               <li><a href="g3"><i class="fa fa-angle-double-right"></i> Generasi 3</a></li>
                               <li><a href="g4"><i class="fa fa-angle-double-right"></i> Generasi 4</a></li>
                               <li><a href="g5"><i class="fa fa-angle-double-right"></i> Generasi 5</a></li>
                               <li><a href="g6"><i class="fa fa-angle-double-right"></i> Generasi 6</a></li>
                               <li><a href="g7"><i class="fa fa-angle-double-right"></i> Generasi 7</a></li>
                               <li><a href="g8"><i class="fa fa-angle-double-right"></i> Generasi 8</a></li>
                               <li><a href="g9"><i class="fa fa-angle-double-right"></i> Generasi 9</a></li>
                               <li><a href="g10"><i class="fa fa-angle-double-right"></i> Generasi 10</a></li>
                            </ul>
                        </li>

                        <li class="active">
                            <a href="binary-tree">
                                <i class="glyphicon fa fa-sitemap"></i> <span>Binary Tree </span>
                            </a>
                        </li>



                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Komisi</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="bonus-sponsor"><i class="fa fa-angle-double-right"></i> Komisi Sponsor</a></li>
                               <li><a href="bonus-pasangan"><i class="fa fa-angle-double-right"></i> Komisi Pasangan</a></li>
                               <li><a href="bonus-level"><i class="fa fa-angle-double-right"></i> Komisi Level</a></li>
                               <li><a href="bonus-leadership"><i class="fa fa-angle-double-right"></i> Bonus Leaders Club</a></li>
                               <li><a href="#"><i class="fa fa-angle-double-right"></i> Komisi Repeat Order</a></li>
                               <li><a href="bonus-royalty-development"><i class="fa fa-angle-double-right"></i><i class="fa fa-angle-double-right"></i> Komisi Development</a></li>
                               <li><a href="bonus-royalty-generasi"><i class="fa fa-angle-double-right"></i><i class="fa fa-angle-double-right"></i> Komisi Generasi</a></li>
                            </ul>
                        </li>


                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Wallet</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="topup"><i class="fa fa-angle-double-right"></i> Topup</a></li>
                               <li><a href="topup-history"><i class="fa fa-angle-double-right"></i> History Topup</a></li>
                               <li><a href="exchange"><i class="fa fa-angle-double-right"></i> Exchange</a></li>
                            </ul>


                       <li class="treeview">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Withdrawal</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="../wallet/withdrawal-request-1"><i class="fa fa-angle-double-right"></i> Withdrawal</a></li>
                               <li><a href="../wallet/withdrawal-onprocess"><i class="fa fa-angle-double-right"></i> On Process</a></li>
                               <li><a href="../wallet/withdrawal-processed"><i class="fa fa-angle-double-right"></i> Processed</a></li>
                            </ul>
                        </li>


                        <li class="active">
                            <a href="../wallet/wallet-report">
                                <i class="glyphicon fa fa-money"></i> <span>History Mutasi</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon glyphicon-shopping-cart"></i></i>
                                <span>Repeat Order</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="product-order"><i class="fa fa-angle-double-right"></i> Order Product</a></li>
                               <li><a href="product-order-history"><i class="fa fa-angle-double-right"></i> History Order</a></li>
                               <li><a href="bonus-ro"><i class="fa fa-angle-double-right"></i> Bonus RO</a></li>
                            </ul>
                        </li>


                        <li class="logout">
                            <a href="logout">
                                <i class="glyphicon fa fa-key"></i> <span>Logout</span>
                                <i class=""></i>
                            </a>
                        </li>

                    </ul>