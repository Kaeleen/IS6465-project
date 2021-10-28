<?php
include '../mysql.php';


$name = $_POST['name'];
$credit = $_POST['credit'];
$quota = $_POST['quota'];
$semester = $_POST['semester'];
$year = $_POST['year'];
$opne_for_enrollment = $_POST['opne_for_enrollment'];
$department_id = $_POST['department_id'];
$prereq_id = $_POST['prereq_id'];
// sql query
$sql = "insert into course (name,credit,quota,semester,year,opne_for_enrollment,department_id,prereq_id) values ('$name','$credit','$quota','$semester','$year','$opne_for_enrollment','$department_id','$prereq_id')";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=course.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
