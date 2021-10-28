<?php
include 'mysql.php';


//get post
$name = $_POST['name'];
$program = $_POST['program'];
$tel = $_POST['tel'];

//sql query
$sql = "insert into student (name,program,tel) values ('$name','$program','$tel')";//常规写法

if(mysqli_query($conn,$sql))
{
    echo 'id is '.mysqli_insert_id($conn).' Insertion succeed!';
    header("refresh:1;url=index_admin.php");
    print('Loading...<br>Will redirect to home page after 1 seconds');
}else{
    echo 'No data';
}
