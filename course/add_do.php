<?php
include '../mysql.php';


$name = $_POST['name'];
$credit = $_POST['credit'];
$semester = $_POST['semester'];
$year = $_POST['year'];
$open_for_enrollment = $_POST['open_for_enrollment'];
$department_id = (int)$_POST['department_id'];
$prereq_id = $_POST['prereq_id'];
// sql query
$sql = "insert into course (course_name,credit,semester,year,open_for_enrollment,department_id,prereq_id) values ('$name','$credit','$semester','$year','$open_for_enrollment','$department_id','$prereq_id')";
if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=course.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
