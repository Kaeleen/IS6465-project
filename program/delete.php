<?php
include '../mysql.php';
$id = $_GET['id'];

$sql = "delete from program where program_id = $id"; // delete by id
if(mysqli_query($conn,$sql))
{
    echo mysqli_affected_rows($conn).' records have been successfully deleted!';
    header("refresh:1;url=program.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else {
    echo 'Failed to delete '.mysqli_affected_rows($conn).' rows';
    header("refresh:1;url=index_admin.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}