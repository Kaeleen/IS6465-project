<?php
include '../mysql.php';
// get data
$id = $_POST['id'];
$prereq_name = $_POST['prereq_name'];
$credit = $_POST['credit'];
// sql query
$sql = "update prereq set prereq_name='$prereq_name',credit='$credit' where prereq_id=$id";

if(mysqli_query($conn,$sql))
{
    echo ' Updated succesfully!';
    header("refresh:1;url=prereqs.php");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}else{
    echo 'No data';
    header("refresh:1;url=index_admin.php");
    print('Loading...<br>Will redirect to homepage after 1 seconds');
}