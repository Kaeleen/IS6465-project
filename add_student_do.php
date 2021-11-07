<?php
include 'mysql.php';


//get post
$name = $_POST['name'];
$program = $_POST['program'];
$tel = $_POST['tel'];
$password = $_POST['password'];
$email = $_POST['email'];
$address = $_POST['address'];


//sql query
$sql = "insert into student (name,program,tel, password, email, address) values ('$name','$program','$tel', '$password', '$email', '$address')";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=index_admin.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
