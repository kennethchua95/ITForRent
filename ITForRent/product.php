<?php

include "account.php";
class product
{

    private $productID, $category, $brand, $description, $status, $costPerDay, $extCostPerDay, $rented, $daysRented, $dueDate, $totalCost =  '';


    function __construct()
    {
        $this->productID;
        $this->category;
        $this->brand;
        $this->description;
        $this->status;
        $this->costPerDay;
        $this->extCostPerDay;
        $this->rented;
        $this->daysRented;
        $this->dueDate;
        $this->totalCost;
    }

    public function getProductID()
    {
        return $this->productID;
    }

    public function getCostPerDay()
    {
        return $this->costPerDay;
    }
    public function getExtCostPerDay()
    {
        return $this->extCostPerDay;
    }
    public function getRentedID()
    {
        return $this->rented;
    }

    public function getDaysRented()
    {
        return $this->daysRented;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }
    public function getTotalCost()
    {
        return $this->totalCost;
    }



    public function showProduct($userType)
    {

        $sql = "SELECT * FROM productlist";
        $result = mysqli_query(connect(), $sql);

        if (mysqli_num_rows($result) != 0) {
?>
            <table name="productTable" border="1" style="overflow:auto" class="table table-bordered table-striped text-center">
                <tr>
                    <th>Product ID</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>cost per day</th>
                    <th>Ext cost per day</th>
                    <th>Rented by</th>
                    <th>Days rented</th>
                    <th>Due date</th>
                    <th>Total $ paid</th>

                </tr>

                <?php


                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";

                    echo "<td><a href= '" . $userType . ".php?id=$row[productID]' name = productIdLink>"  . $row['productID'] . "</a></td>";
                    echo "<td>" . $row['Category'] . "</td>";
                    echo "<td>" . $row['Brand'] . "</td>";
                    echo "<td>" . $row['Description'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "<td>" . '$' . $row['costPerDay'] . "</td>";
                    echo "<td>" . '$' . $row['extCostPerDay'] . "</td>";
                    echo "<td>" . $row['rented'] . "</td>";
                    echo "<td>" . $row['daysRented'] . "</td>";
                    echo "<td>" . $row['dueDate'] . "</td>";
                    echo "<td>" . '$' . $row['totalCost'] . "</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        }

        public function productDetail($productId)
        {
            $sql = "SELECT * FROM productlist WHERE productID = '$productId'";
            $result = mysqli_query(connect(), $sql);

            if (mysqli_num_rows($result) != 0) {

                ?>
                <table name="productTable" border="1" style="overflow:auto" class="table table-bordered table-striped text-center">
                    <tr>
                        <th>Product ID</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>cost per day</th>
                        <th>Ext cost per day</th>
                        <th>Rented by</th>
                        <th>Days rented</th>
                        <th>Due date</th>
                        <th>Total $ paid</th>

                    </tr>

                    <?php


                    while ($row = mysqli_fetch_array($result)) {

                        echo "<tr>";
                        // echo "<td>" . $row['productID'] . "</td>";
                        //echo "<td><a href='buydetails.php?Pnum=$dataaftersplit[3]'>" . $dataaftersplit[3] . "</a></td>";

                        echo "<td><a href= '" . $_SESSION['userType'] . ".php?id=$row[productID]' name = productIdLink>"  . $row['productID'] . "</a></td>";
                        echo "<td>" . $row['Category'] . "</td>";
                        echo "<td>" . $row['Brand'] . "</td>";
                        echo "<td>" . $row['Description'] . "</td>";
                        echo "<td>" . $row['Status'] . "</td>";
                        echo "<td>" . '$' . $row['costPerDay'] . "</td>";
                        echo "<td>" . '$' . $row['extCostPerDay'] . "</td>";
                        echo "<td>" . $row['rented'] . "</td>";
                        echo "<td>" . $row['daysRented'] . "</td>";
                        echo "<td>" . $row['dueDate'] . "</td>";
                        echo "<td>" . '$' . $row['totalCost'] . "</td>";
                        echo "</tr>";

                        $costPerDay = $row['costPerDay'];
                        $extCostPerDay = $row['extCostPerDay'];
                        $daysRented = $row['daysRented'];
                        $dueDate = $row['dueDate'];
                        $totalCost = $row['totalCost'];


                        $this->costPerDay = $costPerDay;
                        $this->extCostPerDay = $extCostPerDay;
                        $this->dueDate = $dueDate;
                        $this->daysRented = $daysRented;
                        $this->totalCost = $totalCost;
                    }
                }
                echo "</table>";
            }



            public function searchProduct($productID, $category, $brand, $status)
            {

                // $sql = "SELECT * FROM productlist WHERE productID LIKE ? AND Category LIKE ? AND Brand LIKE ? AND Status LIKE ?";
                $sql = "SELECT * FROM productlist WHERE productID LIKE '%$productID%' AND Category LIKE '%$category%' AND Brand LIKE '%$brand%' AND Status LIKE '%$status%'";



                // if ($productID != '' and $category != 'empty' and $brand != '' and $status != '') {
                //     $sql = "SELECT * FROM productlist WHERE productID = '$productID' AND Category = '$category' AND Brand ='$brand' AND Status ='$status'";
                //     $sql = "SELECT * FROM productlist WHERE productID LIKE ? AND Category LIKE ? AND Brand LIKE ? AND Status LIKE ?";
                // } elseif ($status == '' and $category == 'empty' and $brand == '') {
                //     $sql = "SELECT * FROM productlist WHERE productID = '$productID'";
                // } elseif ($productID == '' and $brand == '' and $status == '') {
                //     $sql = "SELECT * FROM productlist WHERE Category ='$category'";
                // } elseif ($productID == '' and $category == 'empty' and $status == '') {
                //     $sql = "SELECT * FROM productlist WHERE Brand ='$brand'";
                // } elseif ($productID == '' and $category == 'empty' and $brand == '') {
                //     $sql = "SELECT * FROM productlist WHERE Status ='$status'";
                // } elseif ($status == '' and $brand == '') {
                //     $sql = "SELECT * FROM productlist WHERE productID = '$productID' AND Category = '$category'";
                // } elseif ($category == 'empty' and $status == '') {
                //     $sql = "SELECT * FROM productlist WHERE productID = '$productID'  AND  Brand ='$brand'";
                // } elseif ($category == 'empty' and $brand == '') {
                //     $sql = "SELECT * FROM productlist WHERE productID = '$productID'  AND  Status ='$status'";
                // } elseif ($productID == '' and $category == 'empty') {
                //     $sql = "SELECT * FROM productlist WHERE Brand = '$brand'  AND  Status ='$status'";
                // } elseif ($productID == '' and $status == '') {
                //     $sql = "SELECT * FROM productlist WHERE Brand = '$brand'  AND  Category ='$category'";
                // } elseif ($productID == '' and $brand == '') {
                //     $sql = "SELECT * FROM productlist WHERE Status = '$status'  AND  Category ='$category'";
                // } elseif ($status == '' and $productID != '' and $category != 'empty' and $brand != '') {
                //     $sql = "SELECT * FROM productlist WHERE productID = '$productID' AND Category = '$category' AND Brand ='$brand'";
                // } elseif ($brand == '' and $productID != '' and $category != 'empty' and $status != '') {
                //     $sql = "SELECT * FROM productlist WHERE productID = '$productID' AND Category = '$category' AND Status ='$status'";
                // } elseif ($productID == '' and $brand != '' and $category != 'empty' and $status != '') {
                //     $sql = "SELECT * FROM productlist WHERE Brand = '$brand' AND Category = '$category' AND Status ='$status'";
                // } elseif ($category == 'empty' and $brand != '' and $productID != '' and $status != '') {
                //     $sql = "SELECT * FROM productlist WHERE Brand = '$brand' AND productID = '$productID' AND Status ='$status'";
                // }


                //$sql = "SELECT * FROM productlist";
                $result = mysqli_query(connect(), $sql);

                if (mysqli_num_rows($result) != 0) {
                    ?>
                    <table name="productTable" border="1" style="overflow:auto" class="table table-bordered table-striped text-center">
                        <tr>
                            <th>Product ID</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>cost per day</th>
                            <th>Ext cost per day</th>
                            <th>Rented by</th>
                            <th>Days rented</th>
                            <th>Due date</th>
                            <th>Total $ paid</th>

                        </tr>

                        <?php

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            //  echo "<td>" . $row['productID'] . "</td>";
                            echo "<td><a href= '" . $_SESSION['userType'] . ".php?id=$row[productID]' name = productIdLink>"  . $row['productID'] . "</a></td>";
                            echo "<td>" . $row['Category'] . "</td>";
                            echo "<td>" . $row['Brand'] . "</td>";
                            echo "<td>" . $row['Description'] . "</td>";
                            echo "<td>" . $row['Status'] . "</td>";
                            echo "<td>" . '$' . $row['costPerDay'] . "</td>";
                            echo "<td>" . '$' . $row['extCostPerDay'] . "</td>";
                            echo "<td>" . $row['rented'] . "</td>";
                            echo "<td>" . $row['daysRented'] . "</td>";
                            echo "<td>" . $row['dueDate'] . "</td>";
                            echo "<td>" . '$' . $row['totalCost'] . "</td>";
                            // if ($row['rented'] = "not rented") {
                            //     echo "<td>" . $row['rented'] . "</td>";
                            // } else {
                            //     echo '<td> Yes </td>';
                            // }
                            echo "</tr>";
                        }
                    } else {
                        return "product not found.";
                    }


                    echo "</table>";
                }

                public function showRentedProduct($userType)
                {
                    $sql = "SELECT * FROM productlist WHERE rented !='Not rented'";
                    $result = mysqli_query(connect(), $sql);

                    if (mysqli_num_rows($result) != 0) {
                        ?>
                        <table name="productTable" border="1" style="overflow:auto" class="table table-bordered table-striped text-center">
                            <tr>
                                <th>Product ID</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>cost per day</th>
                                <th>Ext cost per day</th>
                                <th>Rented by</th>
                                <th>Days rented</th>
                                <th>Due date</th>
                                <th>Total $ paid</th>

                            </tr>

                            <?php


                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                //echo "<td>" . $row['productID'] . "</td>";
                                echo "<td><a href= '" . $userType . ".php?id=$row[productID]' name = productIdLink>"  . $row['productID'] . "</a></td>";
                                echo "<td>" . $row['Category'] . "</td>";
                                echo "<td>" . $row['Brand'] . "</td>";
                                echo "<td>" . $row['Description'] . "</td>";
                                echo "<td>" . $row['Status'] . "</td>";
                                echo "<td>" . '$' . $row['costPerDay'] . "</td>";
                                echo "<td>" . '$' . $row['extCostPerDay'] . "</td>";
                                echo "<td>" . $row['rented'] . "</td>";
                                echo "<td>" . $row['daysRented'] . "</td>";
                                echo "<td>" . $row['dueDate'] . "</td>";
                                echo "<td>" . '$' . $row['totalCost'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            return "product not found.";
                        }
                        echo "</table>";
                    }


                    public function showAvailableProduct($userType)
                    {
                        $sql = "SELECT * FROM productlist WHERE rented ='Not rented'";
                        $result = mysqli_query(connect(), $sql);

                        if (mysqli_num_rows($result) != 0) {
                            ?>
                            <table name="productTable" border="1" style="overflow:auto" class="table table-bordered table-striped text-center">
                                <tr>
                                    <th>Product ID</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>cost per day</th>
                                    <th>Ext cost per day</th>
                                    <th>Rented by</th>
                                    <th>Days rented</th>
                                    <th>Due date</th>
                                    <th>Total $ paid</th>

                                </tr>

                                <?php


                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    // echo "<td>" . $row['productID'] . "</td>";
                                    echo "<td><a href= '" . $userType . ".php?id=$row[productID]' name = productIdLink>"  . $row['productID'] . "</a></td>";
                                    echo "<td>" . $row['Category'] . "</td>";
                                    echo "<td>" . $row['Brand'] . "</td>";
                                    echo "<td>" . $row['Description'] . "</td>";
                                    echo "<td>" . $row['Status'] . "</td>";
                                    echo "<td>" . '$' . $row['costPerDay'] . "</td>";
                                    echo "<td>" . '$' . $row['extCostPerDay'] . "</td>";
                                    echo "<td>" . $row['rented'] . "</td>";
                                    echo "<td>" . $row['daysRented'] . "</td>";
                                    echo "<td>" . $row['dueDate'] . "</td>";
                                    echo "<td>" . '$' . $row['totalCost'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                return "product not found.";
                            }
                            echo "</table>";
                        }
                    }

                    class administrator extends account
                    {
                        function adminShowAllProducts($userType)
                        {
                            $product = new product();
                            $product->showProduct($userType);
                        }

                        function adminShowRentedProducts($userType)
                        {
                            $product = new product();
                            $product->showRentedProduct($userType);
                        }

                        function adminShowAvailableProducts($userType)
                        {
                            $product = new product();
                            $product->showAvailableProduct($userType);
                        }

                        function insertProduct($productID, $category, $brand, $description, $status, $costPerDay, $extCostPerDay)
                        {
                            $sqlCheckUser = "SELECT * FROM productlist WHERE productID = '$productID'";
                            $result = mysqli_query(connect(), $sqlCheckUser);
                            //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                            if (mysqli_num_rows($result) == 1) {
                                return false;
                            } else {
                                $sql = "INSERT INTO productlist (productID, Category, Brand, Description, Status, costPerDay, extCostPerDay) 
                    VALUES ('$productID', '$category', '$brand', '$description', '$status', '$costPerDay','$extCostPerDay')";
                                if (connect()->query($sql) === TRUE) {
                                    return true;
                                    //"Product succesfully inserted.";
                                } else {
                                    echo "Error: " . $sql . "<br>" . connect()->error;
                                }
                            }
                        }
                    }


                    class client extends account
                    {
                        public function clientShowAllProducts($userType)
                        {
                            $product = new product();
                            $product->showProduct($userType);
                        }

                        public function clientShowRentedProducts($userType)
                        {
                            $product = new product();
                            $product->showRentedProduct($userType);
                        }

                        public function clientShowAvailableProducts($userType)
                        {
                            $product = new product();
                            $product->showAvailableProduct($userType);
                        }

                        function rentIT($clientID, $daysRented, $dueDate, $totalCost, $productID)
                        {

                            $sql = "SELECT * FROM productlist WHERE rented ='not rented' AND productID ='$productID'";

                            $result = mysqli_query(connect(), $sql);
                            //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                            if (mysqli_num_rows($result) < 1) {
                                return false;
                            } else {

                                $sql = "UPDATE productlist SET rented='$clientID', daysRented='$daysRented',dueDate='$dueDate',totalCost='$totalCost' WHERE productID='$productID'";

                                if (connect()->query($sql) === TRUE) {
                                    return true;
                                } else {

                                    echo "Error: " . $sql . "<br>" . connect()->error;
                                }
                            }
                        }

                        function clientRented($clientID)
                        {
                            $sql = "SELECT * FROM productlist WHERE rented ='$clientID'";
                            $result = mysqli_query(connect(), $sql);

                            if (mysqli_num_rows($result) != 0) {
                                ?>
                                <table name="productTable" border="1" style="overflow:auto" class="table table-bordered table-striped text-center">
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>cost per day</th>
                                        <th>Ext cost per day</th>
                                        <th>Rented by</th>
                                        <th>Days rented</th>
                                        <th>Due date</th>
                                        <th>Total $ paid</th>

                                    </tr>

                        <?php


                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";

                                    echo "<td><a href= '" . $_SESSION['userType'] . ".php?id=$row[productID]' name = productIdLink>"  . $row['productID'] . "</a></td>";
                                    echo "<td>" . $row['Category'] . "</td>";
                                    echo "<td>" . $row['Brand'] . "</td>";
                                    echo "<td>" . $row['Description'] . "</td>";
                                    echo "<td>" . $row['Status'] . "</td>";
                                    echo "<td>" . '$' . $row['costPerDay'] . "</td>";
                                    echo "<td>" . '$' . $row['extCostPerDay'] . "</td>";
                                    echo "<td>" . $row['rented'] . "</td>";
                                    echo "<td>" . $row['daysRented'] . "</td>";
                                    echo "<td>" . $row['dueDate'] . "</td>";
                                    echo "<td>" . '$' . $row['totalCost'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                return "No products rented";
                            }
                            echo "</table>";
                        }

                        function extendIT($clientID, $daysRented, $dueDate, $totalCost, $productID)
                        {

                            $sql = "SELECT * FROM productlist WHERE rented ='$clientID' AND productID ='$productID'";

                            $result = mysqli_query(connect(), $sql);
                            //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                            if (mysqli_num_rows($result) < 1) {
                                return false;
                            } else {

                                $sql = "UPDATE productlist SET rented='$clientID', daysRented='$daysRented',dueDate='$dueDate',totalCost='$totalCost' WHERE productID='$productID'";

                                if (connect()->query($sql) === TRUE) {
                                    return true;
                                } else {

                                    echo "Error: " . $sql . "<br>" . connect()->error;
                                }
                            }
                        }

                        function checkIfRentedByCurrentUser($productID, $clientID)
                        {
                            $sql = "SELECT * FROM productlist WHERE productID ='$productID' and rented ='$clientID'";
                            $result = mysqli_query(connect(), $sql);

                            if (mysqli_num_rows($result) > 0) {
                                return true;
                            } else {
                                return false;
                            }
                        }


                        function checkIfProductRented($productID)
                        {
                            $sql = "SELECT * FROM productlist WHERE productID ='$productID' and rented ='Not rented'";
                            $result = mysqli_query(connect(), $sql);

                            if (mysqli_num_rows($result) > 0) {
                                return false;
                            } else {
                                return true;
                            }
                        }


                        function removeRent($clientID, $productID)
                        {
                            //$sql = "SELECT * FROM productlist WHERE rented !='Not rented'";

                            $sql = "SELECT * FROM productlist WHERE rented ='$clientID' AND productID ='$productID'";

                            $result = mysqli_query(connect(), $sql);
                            //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                            if (mysqli_num_rows($result) < 1) {
                                return false;
                            } else {
                                $a = NULL;
                                $sql = "UPDATE productlist SET rented='Not rented', daysRented='0',dueDate='$a',totalCost='0' WHERE productID='$productID' AND rented='$clientID'";

                                if (connect()->query($sql) === TRUE) {
                                    return true;
                                } else {

                                    echo "Error: " . $sql . "<br>" . connect()->error;
                                }
                            }
                        }
                    }
