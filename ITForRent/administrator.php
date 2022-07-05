<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">

    <div class="container-fluid p-0 bg-primary text-white">
        <div class="row">
            <div class="col-md-10">

            </div>

            <div class="col-md-1">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='post'>
                    <input class="btn btn-secondary" style="float:right" type="submit" name="profile" value="My profile"><br>

            </div>
            <div class="col-md-1">
                <input class="btn btn-danger" style="float:right" type="submit" name="logout" value="Logout">
            </div>
            </form>


        </div>

    </div>
    <div class="container-fluid p-5 bg-primary text-white text-center">

        <?php
        $productID = $brand = $status = $notfound = '';

        include "product.php";
        session_start();

        $loginId  =  $_SESSION['loginID'];
        $userType = $_SESSION['userType'];
        $admin = new administrator();
        $admin->setLoginId($loginId);
        $admin->setUserType($userType);

        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header("Location: main.php");
            die();
        }

        if (isset($_POST['insertProducts'])) {
            header("Location: insertProduct.php");
            die();
        }

        if (isset($_POST['resetTable'])) {
            header("Refresh:0");
        }

        if (isset($_POST['profile'])) {

            header("Location:profile.php");
            die();
        }


        ?>



        <h1>IT for rent</h1><br>
        <h2>Administrator ID: [<?php echo $loginId ?>] </h2>
        <title>Administrator page</title>

        <div class="row mt-3">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='post'>
                <input class="btn btn-info" type="submit" name="showProducts" value="View all products">
                <input class="btn btn-success" type="submit" name="showAvailableProducts" value="View available products">
                <input class="btn btn-danger" type="submit" name="showRentedProducts" value="View rented products">
            </form>

        </div>


        <style>
            label {
                display: inline-block;
                width: 120px;

            }

            .centered {
                position: relative;
                /* or absolute */
                top: 50%;
                left: 50%;
            }
        </style>
    </div>

</head>

<hr>


<body>


    <div class="container ">
        <div class="row">
            <?php
            $products = new product();
            $searchID = '';

            if (isset($_GET['id'])) {
                $searchID = $_GET['id'];
                if ($searchID != null) {
                    $products->productDetail($searchID);
                }
            }



            if (isset($_POST['showProducts'])) {

                //$products->showProduct();
                $admin->adminShowAllProducts($userType);
            }
            if (isset($_POST['search'])) {
                $productID  = trim($_POST["productID"]);
                $category = trim($_POST["category"]);
                $brand = trim($_POST["brand"]);
                $status = trim($_POST["status"]);
                $notfound = $products->searchProduct($productID, $category, $brand, $status);
            }


            if (isset($_POST['showRentedProducts'])) {

                //$notfound = $products->showRentedProduct();
                $notfound = $admin->adminShowRentedProducts($userType);
            }
            if (isset($_POST['showAvailableProducts'])) {
                //$notfound = $products->showAvailableProduct();
                $notfound = $admin->adminShowAvailableProducts($userType);
            }

            ?>
        </div>

        <div class="row mb-2">
            <div class="col-md-10">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='post' autocomplete="off">

                    <h2>Search product</h2>
                    <label for="text">Product ID:</label>
                    <input type="text" placeholder="Enter product ID" id="productID" name="productID" value='<?php echo $productID ?>'><br>

                    <label for="category">Category:</label>
                    <select name="category" id="category">
                        <option value="">empty</option>
                        <option value="laptop">Laptop</option>
                        <option value="router">Router</option>
                        <option value="modem">Modem</option>
                        <option value="others">Others</option>
                    </select><br>

                    <label for="brand">Brand:</label>
                    <input type="text" placeholder="Enter brand" id="brand " name="brand" value='<?php echo $brand ?>'><br>

                    <label for="status">Status:</label>
                    <input type="text" placeholder="Enter status" name="status" id="status" value='<?php echo $status ?>'><br>

                    <input type="submit" name="search" value="Search">
                    <input type="submit" name="resetTable" value="Reset"><br>
                    <div class="col-md-10"></div>

                    <div class="col-md-1">

                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='post'>
                            <input type="submit" name="insertProducts" value="Insert products">
                        </form>

                    </div>
                    <?php echo $notfound; ?>
            </div>

            </form>

        </div>
    </div>

    <hr>
</body>


</html>