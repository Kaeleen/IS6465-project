<?php
include '../mysql.php';


$s_days = $_POST['s_days'];
$s_time = $_POST['s_time'];
$course_id = $_POST['course_id'];
$advisor_id = $_POST['advisor_id'];
$location = $_POST['location'];
//sql query
$sql = "insert into session (s_days,s_time,course_id,advisor_id,location) values ('$s_days','$s_time','$course_id','$advisor_id','$location')";
if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=session.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
