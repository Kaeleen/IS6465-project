<?php
include 'mysql.php';
$sql = "select * from student";
$result = mysqli_query($conn,$sql);
session_start();
if(isset($_SESSION['user'])){
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
    <h3>logged user:<?php echo $_SESSION['user']?></h3>

</head>
<body>

<nav style="text-align: center">
    <a style="margin: 10px" href="#">student</a>
    <a style="margin: 10px" href="advisor/advisor.php">advisor</a>
    <a style="margin: 10px" href="faculty/faculty.php">faculty</a>
    <a style="margin: 10px" href="course/course.php">course</a>
    <a style="margin: 10px"  href="session/session.php">session</a>
    <a style="margin: 10px" href="prereq/prereqs.php">prereqs</a>
    <a style="margin: 10px" href="program/program.php">program</a>
<!--    <a href="#">course list with enrollment count per semester (filtered by semester)</a>-->
</nav>
<h2 style="float:left;width:100%;margin-top:50px; text-align:center">INTI Course Registration System</h2>
<div style="text-align:center">
    <a href="add_student.php" style="padding:3px;font-size:16px;background-color:greenyellow">Add Student Info</a>
    There are <?php echo mysqli_num_rows($result); ?> student in total
</div>
<table style="margin-top:60px" align="center" width="60%" border="" cellspacing="0" cellpadding="0">
    <tr><th>id</th><th>Name</th><th>Program</th><th>Tel.</th><th>Options</th></tr>
    <?php
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr style='background-color:aqua'>
                <td align="center"><?php echo  $row['student_id'];  ?></td>
                <td align="center"><?php echo  $row['name'];  ?></td>
                <td align="center"><?php echo  $row['program'];  ?></td>
                <td align="center"><?php echo  $row['tel'];  ?></td>
                <td align="center">
                    <a href="edit_student.php?id=<?php echo  $row['student_id'];  ?>" style="color:forestgreen">Update</a> | <a href="javascript:del_sure(<?php echo  $row['student_id'];  ?>)" style="color:crimson">Delete</a>|<a href="detail_student.php?id=<?php echo  $row['student_id'];  ?>" style="color:forestgreen">Detail</a>
                </td>
            </tr>
            <?php
        }
    }else{
        echo 'No data';
    }
    ?>
</table>
<script>
    function del_sure(id){
        if(confirm("Confirm to delete") ==true){
            window.location.href="delete_student.php?id="+id;
        }else{
            return ;
        }
    }
</script>
</body>
</html>