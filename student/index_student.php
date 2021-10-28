<?php
include '../mysql.php';
session_start();
$name = $_SESSION['student'];
$student_id = $_SESSION['student_id'];
$courseSql = "select course_id from course where year = '2021' and semester = 'Fall'";
$courseResult = mysqli_query($conn,$courseSql);
$coursrIds = [];
while($row = mysqli_fetch_assoc($courseResult)) {
    $coursrIds[] = $row['course_id'];
}
$coursrIds = implode(',', $coursrIds);
$sql = "select * from student where name = '$name' limit 1";
$sql1 = "select * from enrollment  join course on enrollment.course_id=course.course_id where enrollment.student_id = '$student_id' and  enrollment.course_id in ($coursrIds)";
$sql2 = "select * from enrollment  join course on enrollment.course_id=course.course_id where enrollment.student_id = '$student_id' and  enrollment.course_id not in ($coursrIds)";
//var_dump($sql2);
/*
 * query current semester(Fall 2021)
 */
$result = mysqli_query($conn,$sql);
$result1 = mysqli_query($conn,$sql1);
$result2 = mysqli_query($conn,$sql2);
if(isset($_SESSION['student'])){
}else{
    header('Refresh:0.0001;url=login.php');
    echo "<script> alert('illegal access!')</script>";
    exit();
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <title>Student_info</title>
    <h3>logged user:<?php echo $_SESSION['student']?></h3>

</head>
<body>

<nav style="text-align: center">

</nav>
<h2 style="float:left;width:100%;margin-top:50px; text-align:center">INTI Course Registration System</h2>
<table style="margin-top:60px" align="center" width="60%" border="" cellspacing="0" cellpadding="0">

    <tr><th>id</th><th>Name</th><th>Program</th><th>Tel.</th><th>Options</th></tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <tr style='background-color:aqua'>

                <td align="center"><?php echo  $row['student_id'];  ?></td>
                <td align="center"><?php echo  $row['name'];  ?></td>
                <td align="center"><?php echo  $row['program'];  ?></td>
                <td align="center"><?php echo  $row['tel'];  ?></td>
                <td align="center">
                    <a href="edit.php?id=<?php echo  $row['student_id'];  ?>" style="color:forestgreen">Update</a>
                </td>
            </tr>
    <?php
        }
    ?>
</table>

<div style="text-align:center;margin-top: 100px">
    <a href="add_enrollment.php" style="padding:3px;font-size:16px;background-color:greenyellow">Add enrollment info</a>
    There are <?php echo mysqli_num_rows($result1); ?> courses in current semester
</div>
<table style="margin-top:60px" align="center" width="60%" border="" cellspacing="0" cellpadding="0">

    <tr><th>id</th><th>course_id</th><th>grade</th><th>date_enrolled</th><th>date_dropped</th></tr>
    <?php
    if(mysqli_num_rows($result1) > 0){
    while ($row = mysqli_fetch_assoc($result1)) {
        ?>
        <tr style='background-color:aqua'>
            <td align="center"><?php echo  $row['enroll_id'];  ?></td>
            <td align="center"><?php echo  $row['course_id'];  ?></td>
            <td align="center"><?php echo  $row['grade'];  ?></td>
            <td align="center"><?php echo  $row['date_enrolled'];  ?></td>
            <td align="center"><?php echo  $row['date_dropped'];  ?></td>
<!--            <td align="center">-->
<!--                <a href="edit.php?id=--><?php //echo  $row['student_id'];  ?><!--" style="color:forestgreen">Update</a>-->
<!--            </td>-->
        </tr>
        <?php
    }
    }else{
        echo 'No data';
    }
    ?>
</table>

<div style="text-align:center;margin-top: 100px">
    There are <?php echo mysqli_num_rows($result2); ?> courses registered in previous semesters
</div>
<table style="margin-top:60px" align="center" width="60%" border="" cellspacing="0" cellpadding="0">

    <tr><th>id</th><th>course_id</th><th>grade</th><th>date_enrolled</th><th>date_dropped</th></tr>
    <?php
    if(mysqli_num_rows($result2) > 0){
        while ($row = mysqli_fetch_assoc($result2)) {
            ?>
            <tr style='background-color:aqua'>
                <td align="center"><?php echo  $row['enroll_id'];  ?></td>
                <td align="center"><?php echo  $row['course_id'];  ?></td>
                <td align="center"><?php echo  $row['grade'];  ?></td>
                <td align="center"><?php echo  $row['date_enrolled'];  ?></td>
                <td align="center"><?php echo  $row['date_dropped'];  ?></td>
            </tr>
            <?php
        }
    }else{
        echo 'No data';
    }
    ?>
</table>
</body>
</html>