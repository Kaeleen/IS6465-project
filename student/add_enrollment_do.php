<?php
include '../mysql.php';


$student_id = $_POST['student_id'];
$course_id = $_POST['course_id'];
//$grade = $_POST['grade'];
$date_enrolled = date('Y-m-d');
//$date_dropped = $_POST['date_dropped'];
//sql query
$sql = "insert into enrollment (student_id,course_id,date_enrolled) values ('$student_id','$course_id','$date_enrolled')";

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=index_student.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
