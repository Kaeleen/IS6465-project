<?php
include '../mysql.php';
$id = $_GET['id'];

$sql = "delete from advisor where advisor_id = $id"; 
if(mysqli_query($conn,$sql))
{
    echo mysqli_affected_rows($conn).' records have been successfully deleted!';
    header("refresh:1;url=advisor.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else {
    echo 'Failed to delete '.mysqli_affected_rows($conn).' rows';
    header("refresh:3;url=index_admin.php");
    print('Loading...<br>Will redirect to home page after 3 seconds');
}