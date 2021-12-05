<?php
include '../mysql.php';
$id = $_GET['id'];
$couser_id = $_GET['couser_id'];

$sql = "delete from session where session_id = $id"; //delete by id
if(mysqli_query($conn,$sql))
{
    echo mysqli_affected_rows($conn).' records have been successfully deleted!';
    header("refresh:1;url=edit.php?id=$couser_id");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else {
    echo 'Failed to delete '.mysqli_affected_rows($conn).' rows';
    header("refresh:1;url=edit.php?id=$couser_id");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}