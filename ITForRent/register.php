<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">

    <div class="container-fluid p-0 bg-primary text-white">
        <div id="topleft">
            <button onclick="location.href='main.php'" class="btn btn-success">Back to main </button>
        </div>
    </div>
    <div class="container-fluid p-5 bg-primary text-white text-center">

        <h1>IT for rent</h1><br>
        <h1>Register your account</h1>
        <title>Register</title>

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
    include "account.php";

    $loginID  = $password = $name = $surname = $phone = $email  = '';
    $loginIDError  = $passwordError = $nameError = $surnameError = $phoneError = $emailError = $successMessage  = '';
    $valid = true;
    $phonePattern = "/[896][0-9]{7}$/";

    if (isset($_POST['register'])) {
        $loginID  = trim($_POST["loginID"]);
        $password = trim($_POST["password"]);
        $name = trim($_POST["name"]);
        $surname = trim($_POST["surname"]);
        $phone = trim($_POST["phone"]);
        $email  = trim($_POST["email"]);
        if (isset($_POST['userType'])) {
            $userType = trim($_POST['userType']);
        }
        //$userType = trim($_POST["userType"]);

        if (preg_match($phonePattern, $phone) != 1) {
            $phoneError = ' Invalid phone number ';
            $valid = false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = ' Invalid email address ';
            $valid = false;
        }
        // runs if validation passes
        else if ($valid != false) {
            $newAccount = new account();
            if ($newAccount->registerAccount($loginID, $password, $name, $surname, $phone, $email, $userType) == true) {
                $successMessage = "Account successfully created.";
                $loginID  = $password = $name = $surname = $phone = $email  = '';
            } else {
                $loginIDError = "username already exists.";
            }

            // if ($userType == 'administrator') {
            //     $administrator = new administrator();
            //     if ($administrator->registerAccount($loginID, $password, $name, $surname, $phone, $email, $userType) == true) {
            //         $successMessage = "Account successfully created.";
            //         $loginID  = $password = $name = $surname = $phone = $email  = '';
            //     } else {
            //         $loginIDError = "username already exists.";
            //     }
            // }

            // if ($userType == 'client') {
            //     $client = new client();
            //     if ($client->registerAccount($loginID, $password, $name, $surname, $phone, $email, $userType) == true) {
            //         $successMessage = "Account successfully created.";
            //         $loginID  = $password = $name = $surname = $phone = $email  = '';
            //     } else {
            //         $loginIDError = "username already exists.";
            //     }
            // }
        }
    }


    ?>

    <div class="container ">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='post' autocomplete="off">
            <div class="container">
                <label for="text">Login ID:</label>
                <input type="text" placeholder="Enter login ID" id="loginId" name="loginID" required value='<?php echo $loginID ?>'> <?php echo $loginIDError ?><br>

                <label for="password">Password:</label>
                <input type="password" placeholder="Enter password" id="password " name="password" required value='<?php echo $password ?>'> <?php echo $passwordError ?><br>

                <label for="name">Name:</label>
                <input type="text" placeholder="Enter name" id="name " name="name" required value='<?php echo $name ?>'> <?php echo $nameError ?><br>

                <label for="name">Surname:</label>
                <input type="text" placeholder="Enter surname" id="surname " name="surname" required value='<?php echo $surname ?>'> <?php echo $surnameError ?><br>

                <label for="phone">Phone Number:</label>
                <input type="text" placeholder="Enter Phone number" name="phone" required id="phone" value='<?php echo $phone ?>'><?php echo $phoneError ?><br>

                <label for="name">E-mail:</label>
                <input type="text" placeholder="Enter E-mail address" id="email " name="email" required value='<?php echo $email ?>'> <?php echo $emailError ?><br>


                <label for="userTypes">User Type:</label>
                <select name="userType" id="userType">
                    <!-- <option value="administrator">Administrator</option>
                    <option value="client">Client</option> -->

                    <option value="administrator" <?php if (isset($_GET['userType']) == "administrator") {
                                                        echo "selected=selected";
                                                    } ?>>Administrator</option>
                    <option value="client" <?php if (isset($_GET['userType']) == "client") {
                                                echo "selected=selected";
                                            } ?>>Client</option>
                </select>

                <input type="submit" name="register" value="Register"><br>
            </div>


            <hr>
            <?php echo $successMessage ?>

    </div>




    </form>




</body>


</html>