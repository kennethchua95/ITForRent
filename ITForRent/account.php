<?php

use accountCheck as GlobalAccountCheck;

include "DBConnect.php";
class account
{
    private $loginId, $password, $name, $surname, $phone, $email, $userType = '';

    function default_constructor()
    {
        $this->loginId;
        $this->password;
        $this->name;
        $this->surname;
        $this->phone;
        $this->email;
        $this->userType;
    }

    public function administrator_construct($loginId, $password, $name, $surname, $phone, $email, $userType)
    {
        $this->loginId = $loginId;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
        $this->userType = $userType;
    }

    public function client_construct($loginId, $password, $name, $surname, $phone, $email, $userType)
    {
        $this->loginId = $loginId;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
        $this->userType = $userType;
    }

    public function setLoginId($loginId)
    {
        $this->loginId = $loginId;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }


    public function getLoginId()
    {
        return $this->loginId;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getUserType()
    {
        return $this->userType;
    }


    public function login($loginID, $password, $userType)
    {


        $sqlCheckUser = "SELECT * FROM useraccount WHERE loginID ='$loginID' AND password ='$password' AND userType ='$userType'";

        $result = mysqli_query(connect(), $sqlCheckUser);
        //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) != 1) {
            return 'Account does not exist / password is wrong.';
        } else {
            session_start();
            $_SESSION['loginID'] = $loginID;
            $_SESSION['userType'] = $userType;
            header("Location:" . $userType . ".php");
            die();
        }
    }

    public function registerAccount($loginID, $password, $name, $surname, $phone, $email, $userType)
    {
        $sqlCheckUser = "SELECT * FROM useraccount WHERE loginID = '$loginID'";
        $result = mysqli_query(connect(), $sqlCheckUser);
        //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) == 1) {
            $loginIDError = "Login ID already exists!";
        } else {
            $sql = "INSERT INTO useraccount (loginID, password, name, surname, phone, email, userType) 
            VALUES ('$loginID', '$password', '$name', '$surname', '$phone', '$email','$userType')";
            if (connect()->query($sql) === TRUE) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . connect()->error;
            }
        }
    }


    public function profileInfo($loginID)
    {


        $sqlCheckUser = "SELECT * FROM useraccount WHERE loginID ='$loginID'";

        $result = mysqli_query(connect(), $sqlCheckUser);
        //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) != 0) {
?>
            <table name="productTable" border="1" style="overflow:auto" class="table table-bordered table-striped text-center">
                <tr>
                    <th>Login ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Phone Num</th>
                    <th>Email</th>
                    <th>User Type</th>

                </tr>

    <?php

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['loginID'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['surname'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['userType'] . "</td>";
                echo "</tr>";
            }
        }
    }
}
