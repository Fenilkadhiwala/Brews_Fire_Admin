<?php
include "./connection/connect.php";

session_name("admin");
session_start();
// $err="";
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

if (isset($_GET['pid'])) {

    $pid = $_GET['pid'];

    $upQ = "SELECT * FROM `products` WHERE id='$pid'";
    $upRes = mysqli_query($con, $upQ);

    $upRow = mysqli_fetch_assoc($upRes);

    $name = $upRow['name'];
    $loc = $upRow['location'];
    $desc = $upRow['description'];




}


if (isset($_POST['submit'])) {
    $n = $_POST['name'];
    $l = $_POST['location'];
    $d = $_POST['description'];

    $imageArr = $_FILES['allImg'];

    $totalItems = count($_FILES['allImg']['name']);

    $errorArr = array();
    for ($i = 0; $i < $totalItems; $i++) {
        $errorArr[$i] = $imageArr['error'][$i];
    }

    $sizeArr = array();
    for ($i = 0; $i < $totalItems; $i++) {
        $sizeArr[$i] = $imageArr['size'][$i];
    }

    $extensionArr = array();
    for ($i = 0; $i < $totalItems; $i++) {
        $extensionArr[$i] = pathinfo($imageArr['name'][$i], PATHINFO_EXTENSION);
    }

    $tempArr = array();
    for ($i = 0; $i < $totalItems; $i++) {
        $tempArr[$i] = $imageArr['tmp_name'][$i];
    }

    if (in_array(1, $errorArr)) {
        $er = "Something went wrong while uploading the image";
        header("location:addProduct.php?err=$er");
    } else {
        $flag = 0;

        for ($i = 0; $i < count($sizeArr); $i++) {
            if ($sizeArr[$i] > 1250000) {
                $flag = 1;
            }
        }

        if ($flag == 1) {
            $er = "All image size should be less than 1.25 MB";
            header("location:addProduct.php?err=$er");
        } else {
            $allowed_extension = array('png', 'jpg', 'jpeg');
            $flag1 = 0;

            for ($i = 0; $i < count($extensionArr); $i++) {
                if (in_array($extensionArr[$i], $allowed_extension)) {
                    $flag1 = 0;
                } else {
                    $flag1 = 1;
                    break;
                }
            }
            if ($flag1 != 1) {
                $newNameArr = array();

                for ($i = 0; $i < $totalItems; $i++) {
                    $unique_id = 100 + mt_rand(0, 899);
                    $newNameArr[$i] = 'IMG-' . $unique_id . '.' . $extensionArr[$i];
                }

                $pathArr = array();

                for ($i = 0; $i < $totalItems; $i++) {
                    $pathArr[$i] = 'uploads/' . $newNameArr[$i];
                }

                for ($i = 0; $i < $totalItems; $i++) {
                    move_uploaded_file($tempArr[$i], $pathArr[$i]);
                }

                $joinedWeight = join(",", $_POST["weight"]);
                $joinedQuantity = join(",", $_POST["quantity"]);
                $joinedPrice = join(",", $_POST["price"]);
                $joinedImages = join(",", $newNameArr);

                // $q = "INSERT INTO products(name,location,description,weight,quantity,price,images) VALUES('$name','$location','$description','$joinedWeight','$joinedQuantity','$joinedPrice','$joinedImages')";
                $q = "UPDATE `products` SET name='$n',location='$l',description='$d',weight='$joinedWeight',quantity='$joinedQuantity',price='$joinedPrice',images='$joinedImages' WHERE id='$pid'";

                $res = mysqli_query($con, $q);

                if ($res) {
                    header("location:allProduct.php");
                } else {
                    $er = "Something went wrong while uploading the image";
                    header("location:addProduct.php?err=$er");
                }
            } else {
                $er = "All image should be of png, jpg or jpeg";
                header("location:addProduct.php?err=$er");
            }
        }
    }

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 3</title>

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
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


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
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
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
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
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
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
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
                    <a class="nav-link" href="logout.php">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
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
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    DASHBOARD

                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="addProduct.php" class="nav-link active">
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


                        <li class="nav-header">EXAMPLES</li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Pages
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/examples/invoice.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Invoice</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/profile.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/e-commerce.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>E-commerce</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/projects.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Projects</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/project-add.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Project Add</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/project-edit.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Project Edit</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/project-detail.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Project Detail</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/contacts.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Contacts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/faq.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>FAQ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/contact-us.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Contact us</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
            </nav>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Update The Product</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Admin</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Product Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" enctype="multipart/form-data" autocomplete="off">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product title</label>
                                            <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="<?= $name ?>"
                                                placeholder="Enter Title" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Mfg. Location</label>
                                            <input name="location" type="text" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter location" value="<?= $loc ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Description</label>
                                            <input name="description" type="text" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter description" value="<?= $desc ?>" required>
                                        </div>



                                        <div class="threeCombination">


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Weight</label>
                                                <select name="weight[]" class="form-control" required>
                                                    <option value="">Select weight</option>

                                                    <option value="100 gm.">100 gm</option>
                                                    <option value="250 gm.">250 gm.</option>
                                                    <option value="500 gm.">500 gm.</option>
                                                    <option value="1 kg.">1 kg.</option>

                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Stock</label>
                                                <input name="quantity[]" type="text" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Enter total stock" required>
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Price (pc.)</label>
                                                <input name="price[]" type="text" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Enter price" required>
                                            </div>



                                            <div class="form-group">
                                                <label for="exampleInputFile">Product Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="allImg[]" type="file" class="custom-file-input"
                                                            id="exampleInputFile" required>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            photo</label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" id="addMore" class="btn btn-primary">Add More</button>
                                        <button type="button" id="remove" class="btn btn-primary">Remove</button>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">

                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="dist/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard3.js"></script>
</body>

</html>

<script>
$(document).ready(function() {
    // Function to enable or disable the "Remove" button based on the number of sets
    function updateRemoveButtonState() {
        if ($(".threeCombination").length === 1) {
            $("#remove").prop("disabled", true);
        } else {
            $("#remove").prop("disabled", false);
        }
    }

    $('#addMore').click(function() {
        var cloned = $(".threeCombination:first").clone();
        $(".threeCombination:last").after(cloned);

        cloned.find('select[name="dept[]').val('');
        cloned.find('input[name="price[]"]').val('');
        cloned.find('input[name="quantity[]"]').val('');
        cloned.find('input[type="file"]').val('');

        // Call the function to update the "Remove" button state
        updateRemoveButtonState();
    });

    $('#remove').click(function() {
        $(".threeCombination:last").remove();

        // Call the function to update the "Remove" button state
        updateRemoveButtonState();
    });

    // Initial check to disable the "Remove" button
    updateRemoveButtonState();
});
</script>