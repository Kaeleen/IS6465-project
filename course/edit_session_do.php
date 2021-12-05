<?php
include '../mysql.php';
//get data
$id = $_POST['id'];
$s_days = $_POST['s_days'];
$s_time = $_POST['s_time'];
$course_id = $_POST['course_id'];
$advisor_id = $_POST['advisor_id'];
$location = $_POST['location'];
//sql query
$sql = "update session set s_days='$s_days',s_time='$s_time',course_id='$course_id',advisor_id='$advisor_id',location='$location' where session_id=$id";
if(mysqli_query($conn,$sql))
{
    echo ' Updated succesfully!';
    header("refresh:1;url=edit.php?id=$course_id");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}else{
    echo 'No data';
    header("refresh:1;url=edit.php?id=$course_id");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}