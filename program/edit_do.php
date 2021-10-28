<?php
include '../mysql.php';
//get data
$id = $_POST['id'];
$name = $_POST['name'];
$type = $_POST['type'];
//sql query
$sql = "update program set program_name='$name',type='$type' where program_id=$id";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_affected_rows($conn).' Updated succesfully!';
    header("refresh:1;url=program.php");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}else{
    echo 'No data';
    header("refresh:3;url=index_admin.php");
    print('Loading...<br>Will redirect to homepage after 3 seconds');
}