<?php
include '../mysql.php';
$sql = "select * from course where year = '2021' and semester = 'Fall'";
$result = mysqli_query($conn,$sql);
session_start();
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
    <title>Add enrollment Info</title>
    <style>
        .adds-stu-wrap{
            width: 700px;
            height: auto;
            margin: 0 auto;
            margin-top: 100px;

        }
        .adds-stu{
            float: left;
            width: 100%;
            height: auto;
            background-color: #eee;
            padding: 15px 10px;
        }
        .adds-stu div{
            float: left;
            width: 100%;
            margin-bottom: 20px;
        }
        .adds-stu div>p{
            float: left;
            width: 100px;
            margin: 0 10px 0 0;
            text-align: right;

        }
        .adds-stu div>input{
            float: left;
            width: 260px;
        }
    </style>
</head>
<body>
<div class="adds-stu-wrap">
    <h2 class="head" style="text-align:center">Add Course</h2>
    <div class="adds-stu">
        <form action="add_enrollment_do.php" method="post">
<!--            <div>-->
<!--                <p>course_id:</p>-->
<!--                <input type="text" name="course_id" id="">-->
<!--            </div>-->
            <div>
                <p>course:</p>
                <input type="hidden" name="student_id" value="<?php echo  $_SESSION['student_id'];  ?>" id="">
                <select name="course_id">
                    <?php
                    if(mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value ="<?php echo  $row['course_id'];  ?>"><?php echo  $row['name'];  ?></option>
                            <?php
                        }
                    }else{
                        echo 'No data';
                    }
                    ?>
                </select>
            </div>
<!--            <div>-->
<!--                <p>grade:</p>-->
<!--                <input type="text" name="grade" id="">-->
<!--            </div>-->
<!--            <div>-->
<!--                <p>date_enrolled:</p>-->
<!--                <input type="text" name="date_enrolled" id="">-->
<!--            </div>-->
<!--            <div>-->
<!--                <p>date_dropped:</p>-->
<!--                <input type="text" name="date_dropped" id="">-->
<!--            </div>-->
            <div style="text-align: center">
                <button >Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>