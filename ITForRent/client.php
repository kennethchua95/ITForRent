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
        $productID = $brand = $status = $notfound = $notfound2 = '';

        include "product.php";
        session_start();

        $loginId  =  $_SESSION['loginID'];
        $userType = $_SESSION['userType'];
        $client = new client();
        $client->setLoginId($loginId);
        $client->setUserType($userType);

        //$_SESSION['userType'] == 'client';

        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header("Location: main.php");
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
        <h2>Client ID: [<?php echo $_SESSION['loginID'] ?>] </h2>
        <title>Client page</title>

        <div class="row mt-3">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='post'>
                <input class="btn btn-info" type="submit" name="userRented" value="Show products i rented">
                <input class="btn btn-success" type="submit" name="showAvailableProducts" value="View available products">
                <input class="btn btn-danger" type="submit" name="showRentedProducts" value="View rented products">
                <input class="btn btn-warning" type="submit" name="showProducts" value="View all products">

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

            div.c {
                position: absolute;
                left: 500px;
                width: 300px;
                height: 250px;
                border: 3px solid green;
            }
        </style>
    </div>



</head>

<hr>


<body>

    <div class="container">
        <?php
        $products = new product();
        $searchID = '';
        $rentingProductID = $rentDuration = $rentCost = $returnDate = '';
        $extendProductID = $extRentDuration = $extRentCostValue = $newDueDateValue = $newRentDuration = '';
        $rentingError = '';




        $searchStyle = 'block';
        $rentStyle = 'none';
        $returnStyle = 'none';
        $extendRentStyle = 'none';

        if (isset($_GET['id'])) {
            $searchID = $_GET['id'];
            $clientID = $_SESSION['loginID'];
            $rentingProductID = $_GET['id'];

            // trim($searchID, "\"\'");
            $rentedByAnyone = '';
            $rentedByAnyone = $client->checkIfProductRented($searchID);


            if ($rentedByAnyone == true) {
                $searchStyle = 'block';
                $rentStyle = 'none';
                $returnStyle = 'none';
                $extendRentStyle = 'none';

                $products->productDetail($searchID);
                $rentedByCurrentUser = '';
                $rentedByCurrentUser = $client->checkIfRentedByCurrentUser($searchID, $clientID);

                if ($rentedByCurrentUser == true) {
                    $returnStyle = 'block';
                    $extendRentStyle = 'block';
                    $searchStyle = 'none';
                    $rentStyle = 'none';

                    $dailyCost = $products->getCostPerDay();
                    $extCost = $products->getExtCostPerDay();
                    $currentDueDate = $products->getDueDate();
                    $currentDaysRented = $products->getDaysRented();
                    $currentTotalCost = $products->getTotalCost();

                    if (isset($_POST['extend'])) {
                        $clientID = $_SESSION['loginID'];
                        $valid = '';
                        $valid = $client->checkIfRentedByCurrentUser($rentingProductID, $clientID);
                        if ($valid != true) {
                            $rentingError = 'Product already rented.';
                        } else {
                            $clientID = $_SESSION['loginID'];
                            $daysRented = trim($_POST["extRentDuration"]);
                            $rentCost  = trim($_POST["extRentCostValue"]);
                            $dueDate  = trim($_POST["newDueDateValue"]);

                            $dailyCost = $products->getCostPerDay();
                            $extCost = $products->getExtCostPerDay();
                            $currentDueDate = $products->getDueDate();
                            $currentDaysRented = $products->getDaysRented();
                            $currentTotalCost = $products->getTotalCost();

                            $totalDaysRented = (int)$daysRented + (int)$currentDaysRented;
                            $totalCost = ((int)$rentCost + (int)$currentTotalCost);
                            if ($daysRented < 1) {
                                $notfound2 = 'Please do not input negative days.';
                            } else {
                                $valid = '';

                                //$valid = $products->extendIT($clientID, $totalDaysRented, $dueDate, $totalCost, $rentingProductID);
                                $valid = $client->extendIT($clientID, $totalDaysRented, $dueDate, $totalCost, $rentingProductID);

                                if ($valid == true) {
                                    echo '<script type="text/javascript">';
                                    //  echo 'alert("You have successfully extended renting on product ID: ' . $rentingProductID . ' for $' . $rentCost . ' which bring your total to $'.$totalCost.' and new return date to ' . $dueDate . ' due to extending for an extra ' . $daysRented . ' days.");';
                                    echo 'alert("You have successfully extended renting on product ID: ' . $rentingProductID . ' for ' . $daysRented . ' days, with a cost of $' . $rentCost . '.\nThe new return date is ' . $dueDate . ' and you have paid a total of $' . $totalCost . '.");';

                                    echo 'window.location.href = "client.php";';
                                    echo '</script>';
                                } else {

                                    $notfound2 = 'Failed to extend product.';
                                }
                            }
                        }
                    }




                    if (isset($_POST['return'])) {
                        $returnSuccess = $client->removeRent($clientID, $searchID);
                        if ($returnSuccess == true) {
                            echo '<script type="text/javascript">';
                            echo 'alert("Product successfully returned.");';
                            echo 'window.location.href = "client.php";';
                            echo '</script>';
                        } else {

                            $notfound = 'Failed to rent product.';
                        }
                    }
                }
            } elseif ($rentedByAnyone != true) {

                $products->productDetail($searchID);
                $dailyCost = $products->getCostPerDay();

                $searchStyle = 'none';
                $returnStyle = 'none';
                $extendRentStyle = 'none';
                $rentStyle = 'block';
            }
        }




        ?>
    </div>


    <div class="container">


        <?php

        if (isset($_POST['showProducts'])) {
            // $products->showProduct();
            $client->clientShowAllProducts($userType);
        }

        if (isset($_POST['userRented'])) {
            //$notfound = $products->clientRented($_SESSION['loginID']);
            $notfound = $client->clientRented($loginId);
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
            $client->clientShowRentedProducts($userType);
        }
        if (isset($_POST['showAvailableProducts'])) {
            // $notfound = $products->showAvailableProduct();
            $notfound =  $client->clientShowAvailableProducts($userType);
        }




        ?>

        <script type="text/javascript">
            function showCurrentValue(event) {
                rentDuration = event.target.value;


                const rentCost = rentDuration * <?php echo (int)$dailyCost; ?>;


                var myCurrentDate = new Date();
                var myFutureDate = new Date(myCurrentDate);
                myFutureDate.setDate(myFutureDate.getDate() + parseInt(rentDuration));
                var newDate = myFutureDate.getDate() + '/' + (myFutureDate.getMonth() + 1) + '/' + myFutureDate.getFullYear();


                const rentCosts = document.getElementById("rentCost").innerText = rentCost;
                const dueDate = document.getElementById("returnDate").innerText = newDate;

                document.getElementById("rentCostValue").value = rentCosts;
                document.getElementById("dueDateValue").value = dueDate;

            }
        </script>
        <script type="text/javascript">
            function showCurrentValue2(event) {



                extRentDuration = event.target.value;

                const newRentCost = extRentDuration * <?php echo (int)$extCost; ?>;
                // const newRentCost = rentDurXextCost + <?php echo (int)$currentTotalCost; ?>;

                var storedDate = '<?php echo $currentDueDate; ?>';

                var newStoredDateString = storedDate.replace(/\//g, '-');

                var dateParts = newStoredDateString.split("-");

                var dateObject = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);

                var myFutureDate = new Date(dateObject);
                myFutureDate.setDate(myFutureDate.getDate() + parseInt(extRentDuration));
                var newDate2 = myFutureDate.getDate() + '/' + (myFutureDate.getMonth() + 1) + '/' + myFutureDate.getFullYear();

                var newRentCosts = document.getElementById("updatedRent").innerText = newRentCost;
                var newDueDate = document.getElementById("extReturnDate").innerText = newDate2;

                document.getElementById("extRentCostValue").value = newRentCosts;
                document.getElementById("newDueDateValue").value = newDueDate.toString();

            }
        </script>



        <?php
        if (isset($_POST['Rent'])) {
            $valid = '';
            $valid = $client->checkIfProductRented($rentingProductID);
            if ($valid == true) {
                $rentingError = 'Product already rented.';
            } else {
                $clientID = $_SESSION['loginID'];
                $daysRented = trim($_POST["rentDuration"]);
                $rentCost  = trim($_POST["rentCostValue"]);
                $dueDate  = trim($_POST["dueDateValue"]);
                if ($daysRented < 1) {
                    $notfound = 'Please do not input negative days.';
                } else {
                    $valid = '';
                    $valid = $client->rentIT($clientID, $daysRented, $dueDate, $rentCost, $rentingProductID);

                    if ($valid == true) {
                        echo '<script type="text/javascript">';
                        echo 'alert("You have successfully rented product: ' . $rentingProductID . ' for ' . $daysRented . ' days for $' . $rentCost . '.\nThe Due date is ' . $dueDate . '.");';
                        //echo 'alert("You have successfully rented product: '.$rentingProductID.' for $'.$rentCost.' until '.$returnDate.');';
                        echo 'window.location.href = "client.php";';
                        echo '</script>';
                    } else {

                        $notfound = 'Failed to rent product.';
                    }
                }




                //echo '<script> confirmRent();</script>';
                // $rentingError = 'Product already rented.';
            }
        }






        ?>


        <div class="row">
            <div id="searchDiv" class="col-1 col-md-6" style="display:<?php echo $searchStyle; ?>;">
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

                </form>

                <?php echo $notfound; ?>

            </div>

            <div name="rentDiv" class="col-6" style="display:<?php echo $rentStyle; ?>;">
                <form action="?id=<?php echo $searchID; ?>" method='post' id='rentForm' autocomplete="off">
                    <h2 style="color:red;">Rent product</h2>
                    <label for="text">Product ID:</label>
                    <input type="text" placeholder="Enter product ID" id="rentingProductID" required name="rentingProductID" disabled value='<?php echo $rentingProductID ?>'> <?php echo $rentingError ?><br>

                    <label for="rentDurationlbl">Duration in days:</label>

                    <input type="number" placeholder="Enter rent duration" id="rentDuration" name="rentDuration" oninput="showCurrentValue(event);" value='<?php echo $rentDuration ?>'><br>

                    <label for="rentcostlbl">Rent Cost:</label>
                    <span id="hiddenRent">$</span>
                    <span id="rentCost"></span><br>

                    <input type="text" style="display:none" value="" id="rentCostValue" name="rentCostValue" />
                    <input type="text" style="display:none" value="" id="dueDateValue" name="dueDateValue" />

                    <!-- <input type="text" placeholder='<?php echo $rentCost ?>' id="rentCost " name="rentCost"><br> -->

                    <label for="returnDateLBL">Return By:</label>
                    <span id="returnDate"></span><br>
                    <!-- <input type="text" placeholder='<?php echo $returnDate ?>' name="returnDate" id="returnDate" disabled><br> -->

                    <!-- <input type="submit" name="Rent" value="Rent" onsubmit="confirmRent(); return false"> -->
                    <!-- <input type="submit" name="Rent" value="Rent" onclick="return false"> -->
                    <input type="submit" name="Rent" value="Rent">
                    <!-- <input type="button" name="Rent" value="Rent" onclick="confirmRent();"> -->


                </form>
                <?php echo $notfound; ?>
            </div>

            <div class="container">


                <div class="row">

                    <div name="extendRentDiv" class="col-1 col-md-6" style="display:<?php echo $extendRentStyle; ?>;">
                        <form action="?id=<?php echo $searchID; ?>" method='post' id='extendRentForm' autocomplete="off">
                            <h2>Extend rent duration</h2>
                            <label for="text">Product ID:</label>
                            <input type="text" placeholder="Enter product ID" id="extendProductID" required name="extendProductID" disabled value='<?php echo $rentingProductID ?>'> <?php echo $rentingError ?><br>

                            <label for="rentDurationlbl">Duration in days:</label>
                            <input type="number" placeholder="Enter rent duration" id="extRentDuration" name="extRentDuration" oninput="showCurrentValue2(event);" value='<?php echo $newRentDuration ?>'><br>


                            <label for="updatedRentlbl">Rent Cost:</label>
                            <span id="hiddenRents">$</span>
                            <span id="updatedRent"></span><br>

                            <input type="text" style="display:none" value="" id="extRentCostValue" name="extRentCostValue" />
                            <input type="text" style="display:none" value="" id="newDueDateValue" name="newDueDateValue" />


                            <label for="returnDateLBL">Return By:</label>
                            <span id="extReturnDate"></span><br>

                            <input type="submit" name="extend" value="Extend rent duration">
                        </form>
                        <?php echo $notfound2; ?>
                    </div>

                    <div name="returnDiv" class="col-4 col-md-6" style="display:<?php echo $returnStyle; ?>;">
                        <form action="?id=<?php echo $searchID; ?>" method='post' id='rentForm' autocomplete="off">
                            <h2 style="color:red;">Return Product</h2>
                            <input type="submit" name="return" value="Return Product">
                        </form>
                    </div>
                </div>



            </div>
        </div>








    </div>
    </div>

    <hr>
</body>


</html>