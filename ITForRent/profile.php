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

        <?php

        include "account.php";

        session_start();
        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header("Location: main.php");
            die();
        }

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


        ?>

        <h1>IT for rent</h1><br>

        <?php
        $IdLabel = '';

        if ($_SESSION['userType'] == 'client') {
            $IdLabel = 'Client ';
        } else {
            $IdLabel = 'Administrator ';
        }



        ?>
        <h2> <?php echo $IdLabel ?> ID: [<?php echo $_SESSION['loginID'] ?>] </h2>
        <title>My Profile page</title>


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

    <h1 style="text-align: center;">Profile Page</h1>
    <div class="container ">
        <div class="row">
            <?php
            $account = new account();
            $account->profileInfo($_SESSION['loginID']);

            ?>
        </div>


</body>


</html>