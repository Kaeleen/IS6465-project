<?php
include '../mysql.php';
//get data
$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];
$tel = $_POST['tel'];
//sql query
$sql = "update student set name='$name',tel='$tel' ,password = '$password' where student_id=$id";

if(mysqli_query($conn,$sql))
{
    session_start();
    $_SESSION['student'] = $name;
    $_SESSION['student_id'] = $id;
    echo 'id is '.mysqli_affected_rows($conn).' Updated succesfully!';
    header("refresh:3;url=index_student.php");
    print('Loading...<br>Will redirect to homepage after 3 seconds');
}else{
    echo 'No data';
    header("refresh:3;url=index_student.php");
    print('Loading...<br>Will redirect to homepage after 3 seconds');
}