<?php
include '../mysql.php';


$name = $_POST['name'];
$credit = $_POST['credit'];

// sql query
$sql = "insert into prereq (prereq_name,credit) values ('$name','$credit')";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=prereqs.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
