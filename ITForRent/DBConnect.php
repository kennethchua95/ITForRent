<?php
// DB Config
const DB_SERVER = 'localhost:3306';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'itforrent';

function connect(){
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    return $link;

// Check connection
if ($link === false) {
    die("ERROR: Could not connect: " . mysqli_connect_error());
}

}
// Attempt to connect to MySQL database
