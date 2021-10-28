<?php
include '../mysql.php';


$name = $_POST['name'];
$type = $_POST['type'];
// sql query
$sql = "insert into program (type,program_name) values ('$type','$name')";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=program.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
