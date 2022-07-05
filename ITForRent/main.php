<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">

    <div class="container-fluid p-5 bg-primary text-white text-center">
        <h1>IT for rent</h1>
        <title>IT for rent</title>

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

    <?php $php_errormsg = '';
    include "account.php";

    $loginID  = $password = $userType = '';

    if (isset($_POST['login'])) {
        $loginID  = trim($_POST["loginID"]);
        $password = trim($_POST["password"]);
        $userType = trim($_POST["userType"]);

        $account = new account();
        $php_errormsg = $account->login($loginID, $password, $userType);

        // if ($userType == 'administrator') {
        //     $administrator = new administrator();
        //     $php_errormsg = $administrator->login($loginID, $password, $userType);
        // }

        // if ($userType == 'client') {
        //     $client = new client();
        //     $php_errormsg = $client->login($loginID, $password, $userType);
        // }


    }

    ?>

    <div class="container">
        <form action='main.php' method='post' autocomplete="off">
            <div class="container">

                <label for="text">Login ID:</label>
                <input type="text" placeholder="Enter login ID" id="loginId" name="loginID" required value='<?php echo $loginID ?>'><br>

                <label for="password">Password:</label>
                <input type="password" placeholder="Enter password" id="password " name="password" required value='<?php echo $password ?>'><br>

                <input type="submit" name="login" value="Login"><br>
            </div>

            <div class="container">
                <!-- <label for="userType">Select user type :</label><br> -->
                <div class="col-xs-4">
                    <input type="radio" id="administrator" name="userType" value="administrator" checked>
                    <label for="administrator">Administrator</label><br>
                </div>

                <div class="col-xs-4">
                    <input type="radio" id="client" name="userType" value="client">
                    <label for="client">Client</label><br>

                </div>
                <?php echo $php_errormsg ?>
            </div>
        </form>

    </div>
    <hr>


    <div class="container" style="background-color:#f1f1f1">


        <div class="row">

            <div class="col-2 col-md-6">
                <form action='register.php'>
                    <label style="width:auto" for="text">Register account here.</label><br>
                    <input type="submit" name="register" value="Register">
                </form>
            </div>

            <!-- <div class="col-5 col-md-6">
                <form action='register.php'>
                    <label style="width:auto" for="text">Create Database if not yet created.</label><br>
                    <input type="submit" name="createDB" value="Create database"><br>
                </form>


            </div> -->



        </div>







</body>


</html>