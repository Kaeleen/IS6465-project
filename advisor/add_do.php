<?php
include '../mysql.php';


// get data
$name = $_POST['name'];
// sql query
$sql = "insert into advisor (name) values ('$name')";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=advisor.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
