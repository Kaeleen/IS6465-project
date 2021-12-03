<?php
include '../mysql.php';


$name = $_POST['name'];
$credit = $_POST['credit'];
$semester = $_POST['semester'];
$year = $_POST['year'];
// $open_for_enrollment = $_POST['open_for_enrollment'];
// $prereq_id = $_POST['prereq_id'];

$department = $_POST['department'];

$department_sql = "select department_id from department where department_name = '$department'";
$department_res = mysqli_query($conn,$department_sql);
$row = mysqli_fetch_assoc($department_res);
$department_id = (int)$row['department_id'];

$prereq = $_POST['prereq'];

$prereq_sql = "select prereq_id from prereq where prereq_name = '$prereq'";
$prereq_res = mysqli_query($conn,$prereq_sql);
$row1 = mysqli_fetch_assoc($prereq_res);
$prereq_id = (int)$row1['prereq_id'];


// sql query
$sql = "insert into course (course_name,credit,semester,year,department_id,prereq_id) values ('$name','$credit','$semester','$year','$department_id','$prereq_id')";
if(mysqli_query($conn,$sql))
{
    $s_days = $_POST['s_days'];
    $s_time = $_POST['s_time'];
    $course_id = mysqli_insert_id($conn);
    $advisor = $_POST['advisor'];

    $advisor_sql = "select advisor_id from advisor where name = '$advisor'";
    $advisor_res = mysqli_query($conn,$advisor_sql);
    $row2 = mysqli_fetch_assoc($advisor_res);
    $advisor_id = $row2['advisor_id'];

    $quota = $_POST['quota'];
    $location = $_POST['location'];
    $sql = "insert into session (s_days,s_time,course_id,advisor_id,quota,location) values ('$s_days','$s_time','$course_id','$advisor_id','$quota','$location')";
    if(mysqli_query($conn,$sql))
    {
        echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
        header("refresh:1;url=course.php");
        print('Loading...<br>Will redirect to home page after 1 seconds');
    }else{
        echo 'No data';
    }
}else{
    echo 'No data';
}
