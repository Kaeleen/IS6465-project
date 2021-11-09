<?php
include 'mysql.php';
// get username and password
$name = $_POST['name'];
$pass = $_POST['password'];
// query username and password from database
$sqlsel="select name,password from admin where name='$name' and password='$pass'";
$result=mysqli_query($conn, $sqlsel);

if($result->num_rows==1){
    session_start();
    $_SESSION['user'] = $name;
//    $_SESSION['username'] = $name;
//    var_dump($_SESSION);
    header("Refresh:0.0001;url=index_admin.php");
    echo "<script> alert('Login succeed!')</script>";
    exit();
}else {
    $sqlsel = "select * from advisor where name='$name' and password='$pass'";
    $result = mysqli_query($conn, $sqlsel);

    if ($result->num_rows == 1) {
        session_start();
        $_SESSION['user'] = $name;
        $row = mysqli_fetch_assoc($result);
        $_SESSION['advisor_id'] = $row['advisor_id'];
        header("Refresh:0.0001;url=advisor_admin/index_advisor.php?year=2021&semester=Fall");
        echo "<script> alert('Login succeed!')</script>";
        exit();
    } else {
        $sqlsel = "select * from student where name='$name' and password='$pass'";
        $result = mysqli_query($conn, $sqlsel);

        if ($result->num_rows == 1) {
            session_start();
            $_SESSION['student'] = $name;
            $row = mysqli_fetch_assoc($result);
            $_SESSION['student_id'] = $row['student_id'];
            header("Refresh:0.0001;url=student/index_student.php?year=2021&semester=Fall");
            echo "<script> alert('Login succeed!')</script>";
            exit();
        } else {
            header("Refresh:0.0001;url=login.php");
            echo "<script> alert('Login failed!')</script>";
            exit();
        }
    }
}



