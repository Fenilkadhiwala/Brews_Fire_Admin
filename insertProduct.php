<?php
include "./connection/connect.php";

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];

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

                $q = "INSERT INTO products(name,location,description,weight,quantity,price,images) VALUES('$name','$location','$description','$joinedWeight','$joinedQuantity','$joinedPrice','$joinedImages')";

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
