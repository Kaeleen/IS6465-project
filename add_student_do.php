<?php
include 'mysql.php';


// get post
$name = $_POST['name'];
$program = $_POST['program'];
$tel = $_POST['tel'];
$dob = $_POST['dob'];
$password = $_POST['password'];
$address = $_POST['address'];
$email = $_POST['email'];

$program_sql = "select program_id from program where program_name = '$program'";
$program_res = mysqli_query($conn,$program_sql);
$row = mysqli_fetch_assoc($program_res);
$program_id = $row['program_id'];

//sql query
$sql = "insert into student (name,program_id,tel, dob, password, address, email) values ('$name','$program_id','$tel', '$dob', '$password', '$address', '$email')";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=index_admin.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
