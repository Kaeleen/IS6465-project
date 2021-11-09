<?php
include '../mysql.php';
$id = $_GET['id'];

# delete by id
$sql = "delete from course where course_id = $id"; 
if(mysqli_query($conn,$sql))
{
    echo mysqli_affected_rows($conn).' records have been successfully deleted!';
    header("refresh:1;url=course.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else {
    echo 'Failed to delete '.mysqli_affected_rows($conn).' rows';
    header("refresh:1;url=index_admin.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}