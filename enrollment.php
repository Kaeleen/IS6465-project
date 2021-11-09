<?php
include 'mysql.php';
session_start();
$year_sql = "select * from course";
$year_result = mysqli_query($conn,$year_sql);
$year = $semester = [];
while ($row = mysqli_fetch_assoc($year_result)) {
    $year[] =$row['year'];
    $semester[]=$row['semester'];
}
$year = array_unique($year);
$semester = array_unique($semester);

$year_get = $_GET['year'] ?  $_GET['year'] : '2021';
$semester_get = $_GET['semester'] ? $_GET['semester'] : 'Fall';
$courseSql = "select course_id from course where year = '$year_get' and semester = '$semester_get'";
$courseResult = mysqli_query($conn,$courseSql);
$coursrIds = [];
while($row = mysqli_fetch_assoc($courseResult)) {
    $coursrIds[] = $row['course_id'];
}
$coursrIds = implode(',', $coursrIds);
$sql2 = "select enrollment.* ,course.* from enrollment join course on enrollment.course_id=course.course_id where  enrollment.course_id  in ($coursrIds)";

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
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <title>User_info</title>
    <h3>logged user:<?php echo $_SESSION['user']?></h3>
    <a style="margin: 10px" href="login.php">log out</a>

</head>
<body>

<nav style="text-align: center">
    <a href="index_admin.php">index</a>
</nav>
<h2 style="float:left;width:100%;margin-top:50px; text-align:center">INTI Course Registration System</h2>

<div style="text-align: center;margin-top: 80px">
    year:
    <select name="year" id="year">
        <?php
          foreach ($year as $item){
                ?>
                <option value ="<?php echo  $item;  ?>" <?php if ($item == $year_get){ ?>selected="" <?php } ?> ><?php echo  $item;  ?></option>
                <?php
            }

        ?>
    </select>
    semester:
    <select name="semester" id="semester">
        <?php
        foreach ($semester as $item){
            ?>
            <option value ="<?php echo  $item;  ?>" <?php if ($item == $semester_get){ ?>selected="" <?php } ?>><?php echo  $item;  ?></option>
            <?php
        }
        ?>
    </select>
    <button onclick="search()">go</button>
</div>
<table style="margin-top:60px" align="center" width="60%" border="" cellspacing="0" cellpadding="0">
    <tr><th>course_id</th><th>year</th><th>semester</th><th>course</th><th>grade</th><th>date_enrolled</th><th>date_dropped</th></tr>
    <?php
    if ($result2){
    if(mysqli_num_rows($result2) > 0){
        while ($row = mysqli_fetch_assoc($result2)) {
            ?>
            <tr style='background-color:aqua'>
<!--                <td align="center">--><?php //echo  $row['enroll_id'];  ?><!--</td>-->
                <td align="center"><?php echo  $row['course_id'];  ?></td>
                <td align="center"><?php echo  $row['year'];  ?></td>
                <td align="center"><?php echo  $row['semester'];  ?></td>
                <td align="center"><?php echo  $row['name'];  ?></td>
                <td align="center"><?php echo  $row['grade'];  ?></td>
                <td align="center"><?php echo  $row['date_enrolled'];  ?></td>
                <td align="center"><?php echo  $row['date_dropped'];  ?></td>
            </tr>
            <?php
        }
    }}
    ?>
</table>
</body>
<script>
       function search(){
           var $year = $("#year").val(),
               $semester  = $("#semester").val();
           location.href = 'enrollment.php?year='+$year+'&semester='+$semester
       }
</script>
</html>