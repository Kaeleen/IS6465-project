<?php

$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "project_new";
$char   = 'utf8';
// create connection
$conn = mysqli_connect($servername, $username, $password,
    $dbname);
// check connection
if (!$conn) {
    die("Connectionfailed: " . mysqli_connect_error());
}
mysqli_set_charset($conn,$char);
