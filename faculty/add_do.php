<?php
include '../mysql.php';


$name = $_POST['name'];
// sql query
$sql = "insert into faculty (name) values ('$name')";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=faculty.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
