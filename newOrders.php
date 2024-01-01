<?php

include "./connection/connectCustomer.php";
include "./connection/connect.php";

session_name("admin");

session_start();
if (!isset($_SESSION['adminId'])) {
    header("location:index.php");
}

if (isset($_SESSION["fname"]) && isset($_SESSION['lname'])) {

    $fn = $_SESSION['fname'];
    $ln = $_SESSION['lname'];
} else {
    $fn = "Admin";
    $ln = '';
}









?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Invoice</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font: Source Sans Pro -->



    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="icon" type="image" href="fi1.png">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Brews Fire</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            <?php
                            echo $fn . ' ' . $ln;
                            ?>

                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item menu-open">
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    DASHBOARD

                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="addProduct.php" class="nav-link">
                                <i class="nav-icon fas fa-add"></i>
                                <p>
                                    ADD PRODUCTS
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="allProduct.php" class="nav-link">
                                <i class="nav-icon fa-solid fa-list"></i>
                                <p>
                                    ALL PRODUCTS
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="newOrders.php" class="nav-link active">
                                <i class="nav-icon fa-solid fa-truck"></i>
                                <p>
                                    New Orders
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>All Order Details</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">New Orders</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">



                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                               
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table id="example1" class="table table-bordered table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Contact</th>
                                                    <th>City/State</th>
                                                    <th>Address</th>
                                                    <th>Ordered Product</th>
                                                    <th>Ordered Date</th>
                                                    <th>Payment Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php

                                                $orderQ = "SELECT * FROM `orders` ORDER BY id DESC";
                                                $orderRes = mysqli_query($conCust, $orderQ);

                                                while ($orderRows = mysqli_fetch_assoc($orderRes)) {
                                                    $orId = $orderRows['id']; //42
                                                    $cust_id = $orderRows['cust_id']; //30

                                                    // echo $cust_id . '<br>';
                                                    $orderQuery = "SELECT order_date,delivery_status FROM `orders` WHERE cust_id='$cust_id' AND id='$orId'";

                                                    $orderRe = mysqli_query($conCust, $orderQuery);
                                                    $orderRow = mysqli_fetch_assoc($orderRe);

                                                    $orderedDate = $orderRow['order_date'];
                                                    $ds = $orderRow['delivery_status'];

                                                    if ($ds == 0) {
                                                        $custQ = "SELECT * FROM `register` WHERE id='$cust_id'";
                                                        $custRes = mysqli_query($conCust, $custQ);

                                                        $custRow = mysqli_fetch_assoc($custRes);

                                                        $firstName = $custRow['fname'];
                                                        $lastName = $custRow['lname'];
                                                        $phoneNum = $custRow['contact'];

                                                        $addQ = "SELECT * FROM `address` WHERE cust_id='$cust_id'";

                                                        $addRes = mysqli_query($conCust, $addQ);

                                                        $addRow = mysqli_fetch_assoc($addRes);

                                                        $city = $addRow['city'];
                                                        $state = $addRow['state'];
                                                        $fa = $addRow['fullAddress'];

                                                        $nameQ = "SELECT * FROM `history` WHERE cust_id='$cust_id' AND oid='$orId'";
                                                        $nameRes = mysqli_query($conCust, $nameQ);
                                                        $spName = "";

                                                        if (mysqli_num_rows($nameRes) > 0) {
                                                            while ($nameRow = mysqli_fetch_assoc($nameRes)) {
                                                                $spName = $spName . " " . $nameRow['spName'] . ", " . "(" . $nameRow['spWeight'] . ")" . ", " . $nameRow['qty'];
                                                                $c = "black";
                                                            }

                                                        } else {
                                                            $spName = "Order Canceled";
                                                            $c = "red";

                                                        }
                                                        // $payQ = "SELECT * FROM `orders` WHERE cust_id='$cust_id' ORDER BY id DESC LIMIT 1";
                                                        $payQ = "SELECT * FROM `orders` WHERE cust_id='$cust_id' AND id='$orId'";
                                                        $payRes = mysqli_query($conCust, $payQ);
                                                        $payRow = mysqli_fetch_assoc($payRes);


                                                        $paySt = $payRow['payment_status'];


                                                        if ($paySt == 1) {
                                                            $payStatus = "Done";
                                                            $rang = "green";
                                                        } else {
                                                            $payStatus = "COD";
                                                            $rang = "red";
                                                        }




                                                        echo '
                                                    <tr>
                                                    <td>' . $firstName . " " . $lastName . '</td>
                                                    <td>' . $phoneNum . '</td>
                                                    <td>' . $city . ", " . $state . '</td>
                                                    <td>' . $fa . '</td>
                                                    <td  style="font-weight:bolder; color:' . $c . ';">' . $spName . '</td>
                                                    <td>' . $orderedDate . '</td>
                                                    <td style="color:' . $rang . ';font-weight:bolder;">' . $payStatus . '</td>
                                                    <td>
                                                    <a href="deleteOrder.php?oid=' . $cust_id . '"><i class="fa-solid fa-trash"></i></a>
                                                    </td>
                                                    </tr>
                                                    ';




                                                    }

                                                }


                                                ?>



                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Contact</th>
                                                    <th>City/State</th>
                                                    <th>Address</th>
                                                    <th>Ordered Product</th>
                                                    <th>Ordered Date</th>
                                                    <th>Payment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->


                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->

                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer no-print">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
</body>

</html>