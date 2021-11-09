<?php
include '../mysql.php';
$sql = "select * from session ";
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
    <title>session_info</title>
    <h3>logged user:<?php echo $_SESSION['user']?></h3>

</head>
<body>

<nav style="text-align: center">
    <a href="../index_admin.php">index</a>
</nav>
<h2 style="float:left;width:100%;margin-top:50px; text-align:center">INTI Course Registrationn System</h2>

<div style="text-align:center">
    <a href="add.php" style="padding:3px;font-size:16px;background-color:greenyellow">Add session info</a>
    There are <?php echo mysqli_num_rows($result); ?> sessions in total
</div>

<table style="margin-top:60px" align="center" width="60%" border="" cellspacing="0" cellpadding="0">
    <tr><th>id</th><th>s_days</th><th>s_time</th><th>course_id</th><th>advisor_id</th><th>location</th><th>Options</th></tr>
    <?php
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr style='background-color:aqua'>
                <td align="center"><?php echo  $row['session_id'];  ?></td>
                <td align="center"><?php echo  $row['s_days'];  ?></td>
                <td align="center"><?php echo  $row['s_time'];  ?></td>
                <td align="center"><?php echo  $row['course_id'];  ?></td>
                <td align="center"><?php echo  $row['advisor_id'];  ?></td>
                <td align="center"><?php echo  $row['location'];  ?></td>
                <td align="center">
                    <a href="edit.php?id=<?php echo  $row['session_id'];  ?>" style="color:forestgreen">Update</a> | <a href="javascript:del_sure(<?php echo  $row['session_id'];  ?>)" style="color:crimson">Delete</a>|<a href="detail.php?id=<?php echo  $row['session_id'];  ?>" style="color:forestgreen">detail</a>
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
            window.location.href="delete.php?id="+id;
        }else{
            return ;
        }
    }
</script>
</body>
</html>