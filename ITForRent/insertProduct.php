<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">

    <div class="container-fluid p-0 bg-primary text-white">
        <div class="row">
            <div class="col-md-1">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='post'>
                    <input class="btn btn-success" type="submit" name="back" value="Back">
                </form>
            </div>
            <div class="col-md-9">

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

        <h1>IT for rent</h1><br>
        <h1>Insert a new product</h1>
        <title>Insert new product</title>

        <style>
            label {
                display: inline-block;
                width: 120px;

            }

            .topleft {
                position: relative;
                /* or absolute */
                top: 100%;
                left: 100%;
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

    <?php
    include "product.php";

    $productID = $brand = $description = $status = $costPerDay  = $extCostPerDay = '';
    $productIDError  = $categoryError = $BrandError = $DescriptionError = $StatusError = $costPerDayError = $extCostPerDayError  = '';
    $successMessage = "";
    $valid = true;

    session_start();
    if (isset($_POST['back'])) {
        header("Location:" . $_SESSION['userType'] . ".php");
        die();
    }

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: main.php");
        die();
    }

    if (isset($_POST['profile'])) {

        header("Location:profile.php");
        die();
    }

    if (isset($_POST['insert'])) {
        $productID  = trim($_POST["productID"]);
        $category = trim($_POST["category"]);
        $brand = trim($_POST["brand"]);
        $description = trim($_POST["description"]);
        $status = trim($_POST["status"]);
        $costPerDay  = trim($_POST["costPerDay"]);
        $extCostPerDay = trim($_POST["extCostPerDay"]);


        if ($costPerDay < 1) {
            $costPerDayError = ' Invalid amount ';
            $valid = false;
        }

        if ($extCostPerDay < 1) {
            $extCostPerDayError = ' Invalid amount ';
            $valid = false;
        }
        // runs if validation passes
        else if ($valid != false) {

            $admin = new administrator();

            if ($admin->insertProduct($productID, $category, $brand, $description, $status, $costPerDay, $extCostPerDay) == true) {

                $successMessage = "Product successfully inserted.";

                $productID = $brand = $description = $status = $costPerDay  = $extCostPerDay = $productIDError  = '';
            } else {
                $productIDError = "Product ID already exists!";
            }
        }
    }


    ?>

    <div class="container ">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='post' autocomplete="off">
            <div class="container">
                <label for="text">Product ID:</label>
                <input type="text" placeholder="Enter product ID" id="productID" name="productID" required value='<?php echo $productID ?>'> <?php echo $productIDError ?><br>

                <label for="category">Category:</label>
                <select name="category" id="category">
                    <option value="laptop" <?php if (isset($_GET['category']) == "laptop") {
                                                echo "selected=selected";
                                            } ?>>Laptop</option>
                    <option value="router" <?php if (isset($_GET['category']) == "router") {
                                                echo "selected=selected";
                                            } ?>>Router</option>
                    <option value="modem" <?php if (isset($_GET['category']) == "modem") {
                                                echo "selected=selected";
                                            } ?>>Modem</option>
                    <option value="others" <?php if (isset($_GET['category']) == "others") {
                                                echo "selected=selected";
                                            } ?>>Others</option>
                </select><br>

                <label for="brand">Brand:</label>
                <input type="text" placeholder="Enter brand" id="brand " name="brand" required value='<?php echo $brand ?>'> <?php echo $BrandError ?><br>

                <label for="name">Description:</label>
                <input type="text" placeholder="Enter description" id="description " name="description" required value='<?php echo $description ?>'> <?php echo $DescriptionError ?><br>


                <label for="status">Status:</label>
                <input type="text" placeholder="Enter status" name="status" required id="status" value='<?php echo $status ?>'><?php echo $StatusError ?><br>

                <label for="name">Cost Per Day:</label>
                <input type="number" placeholder="Enter cost per day" id="costPerDay " name="costPerDay" required value='<?php echo $costPerDay ?>'> <?php echo $costPerDayError ?><br>

                <label for="name">Ext Cost Per Day:</label>
                <input type="number" placeholder="Enter extended costPerDay" id="extCostPerDay " name="extCostPerDay" required value='<?php echo $extCostPerDay ?>'> <?php echo $extCostPerDayError ?><br>

                <input type="submit" name="insert" value="insert"><br>
            </div>


            <hr>
            <?php echo $successMessage ?>

    </div>




    </form>




</body>


</html>