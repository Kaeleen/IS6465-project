<?php
include '../mysql.php';
    $s_days = $_POST['s_days'];
    $s_time = $_POST['s_time'];
    $course_id = $_POST['course_id'];
    $advisor_id = $_POST['advisor_id'];
    $quota = $_POST['quota'];
    $location = $_POST['location'];
$sql1 = "select count(*) as session_name from session where  course_id=$course_id";
$max_result = mysqli_query($conn,$sql1);
$max_result = mysqli_fetch_assoc($max_result);
$session_name = $max_result['session_name'];
$prereq_result = mysqli_query($conn,$sql1);
    $sql = "insert into session (s_days,s_time,course_id,advisor_id,quota,location,session_name) values ('$s_days','$s_time','$course_id','$advisor_id','$quota','$location','$session_name')";
    if(mysqli_query($conn,$sql))
    {
        echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
        header("refresh:1;url=edit.php?id=$course_id");
        print('Loading...<br>Will redirect to home page after 1 seconds');
    }else{
        echo 'No data';
    }

