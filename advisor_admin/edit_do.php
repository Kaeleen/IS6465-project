<?php
include '../mysql.php';
//get data
$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];
//sql query
$sql = "update advisor set name='$name' ,password = '$password' where advisor_id=$id";

if(mysqli_query($conn,$sql))
{
    session_start();
    $_SESSION['user'] = $name;
    $_SESSION['advisor_id'] = $id;
    echo ' Updated succesfully!';
    header("refresh:1;url=index_advisor.php?year=2021&semester=Fall");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}else{
    echo 'No data';
    header("refresh:1;url=index_advisor.php?year=2021&semester=Fall");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}