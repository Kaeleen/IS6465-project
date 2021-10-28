<?php
include '../mysql.php';
// get data
$id = $_POST['id'];
$name = $_POST['name'];
$credit = $_POST['credit'];
$quota = $_POST['quota'];
$semester = $_POST['semester'];
$year = $_POST['year'];
$opne_for_enrollment = $_POST['opne_for_enrollment'];
$department_id = $_POST['department_id'];
$prereq_id = $_POST['prereq_id'];
// sql query
$sql = "update course set name='$name',credit='$credit',quota='$quota',semester='$semester',year='$year',opne_for_enrollment='$opne_for_enrollment',department_id='$department_id',prereq_id='$prereq_id' where course_id=$id";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_affected_rows($conn).' Updated succesfully!';
    header("refresh:1;url=course.php");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}else{
    echo 'No data';
    header("refresh:3;url=index_admin.php");
    print('Loading...<br>Will redirect to homepage after 3 seconds');
}