<?php
include '../mysql.php';
// get data
$id = $_POST['id'];
$name = $_POST['name'];
// sql query
$sql = "update faculty set name='$name' where faculty_id=$id";

if(mysqli_query($conn,$sql))
{
    echo ' Updated succesfully!';
    header("refresh:1;url=faculty.php");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}else{
    echo 'No data';
    header("refresh:1;url=index_admin.php");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}