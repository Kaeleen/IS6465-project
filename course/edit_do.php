<?php
include '../mysql.php';
// get data
$id = $_POST['id'];
$name = $_POST['name'];
$credit = $_POST['credit'];
$semester = $_POST['semester'];
$year = $_POST['year'];
$department_id = $_POST['department_id'];
$prereq_id = $_POST['prereq_id'] ?? [];
$prereq_id=implode(',',$prereq_id);
// sql query
$sql = "update course set course_name='$name',credit='$credit',semester='$semester',year='$year',department_id='$department_id',prereq_id='$prereq_id' where course_id=$id";
if(mysqli_query($conn,$sql))
{
    echo ' Updated succesfully!';
    header("refresh:1;url=edit.php?id=$id");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}else{
    echo 'No data';
//    header("refresh:1;url=edit.php?id=$id");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}