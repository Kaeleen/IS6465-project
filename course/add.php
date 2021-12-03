<?php
include '../mysql.php';
$sql1 = "select * from prereq";
$prereq_result = mysqli_query($conn,$sql1);

$sql2 = "select * from faculty";
$faculty_result = mysqli_query($conn,$sql2);

$sql3 = "select * from advisor";
$advisor_result = mysqli_query($conn,$sql3);

$sql4 = "select * from department";
$department_result = mysqli_query($conn,$sql4);

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
    <title>Add New Course</title>
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
    <h2 class="head" style="text-align:center">Add New Course</h2>
    <div class="adds-stu">
        <form action="add_do.php" method="post">
            <div>
                <p>Name:</p>
                <input type="text" name="name" id="">
            </div>
            <div>
                <p>Credit:</p>
                <input type="text" name="credit" id="">
            </div>
            <div>
                <p>semester:</p>
                <input type="text" name="semester" id="">
            </div>
            <div>
                <p>year:</p>
                <input type="text" name="year" id="">
            </div>
    
            <div>
                <p>department:</p>
                 <select name="department">
                    <?php
                    if(mysqli_num_rows($department_result) > 0){
                        while ($row = mysqli_fetch_assoc($department_result)) {
                            ?>
                            <option value ="<?php echo  $row['department_name'];  ?>"><?php echo  $row['department_name'];  ?></option>
                            <?php
                        }
                    }else{
                        echo 'No data';
                    }
                    ?>
                </select>
            </div>
            <div>
                <p>prerequisite:</p>
                 <select name="prereq">
                    <?php
                    if(mysqli_num_rows($prereq_result) > 0){
                        while ($row = mysqli_fetch_assoc($prereq_result)) {
                            ?>
                            <option value ="<?php echo  $row['prereq_name'];  ?>"><?php echo  $row['prereq_name'];  ?></option>
                            <?php
                        }
                    }else{
                        echo 'No data';
                    }
                    ?>
                </select>
            </div>
            session1
            <div>
                <p>s_days:</p>
                <input type="text" name="s_days" id="">
            </div>
            <div>
                <p>s_time:</p>
                <input type="text" name="s_time" id="">
            </div>
         <!--    <div>
                <p>course_id:</p>
                <input type="text" name="course_id" id="">
            </div> -->
            <div>
                <p>quota:</p>
                <input type="text" name="quota" id="">
            </div>
            <div>
                <p>advisor:</p>
                <select name="advisor">
                    <?php
                    if(mysqli_num_rows($advisor_result) > 0){
                        while ($row = mysqli_fetch_assoc($advisor_result)) {
                            ?>
                            <option value ="<?php echo  $row['name'];  ?>"><?php echo  $row['name'];  ?></option>
                            <?php
                        }
                    }else{
                        echo 'No data';
                    }
                    ?>
                </select>
            </div>
            <div>
                <p>location:</p>
                <input type="text" name="location" id="">
            </div>
            <div style="text-align: center">
                <button >Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>