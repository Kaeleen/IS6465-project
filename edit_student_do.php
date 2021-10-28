<?php
include 'mysql.php';
// get data
$id = $_POST['id'];
$name = $_POST['name'];
$tel = $_POST['tel'];
// sql query
$sql = "update student set name='$name',tel='$tel' where student_id=$id";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_affected_rows($conn).' Updated succesfully!';
    header("refresh:3;url=index_admin.php");
    print('Loading...<br>Will redirect to homepage after 3 seconds');
}else{
    echo 'No data';
    header("refresh:3;url=index_admin.php");
    print('Loading...<br>Will redirect to homepage after 3 seconds');
}