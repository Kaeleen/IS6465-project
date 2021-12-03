<?php

$hn = 'localhost:3306';
$db = 'project_new';
$un = 'root';
$pw = ''; //for MAC 'root'


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

?>