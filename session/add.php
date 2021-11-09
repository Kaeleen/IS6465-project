<?php
include '../mysql.php';
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
    <title>Add session Info</title>
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
    <h2 class="head" style="text-align:center">Add session Info</h2>
    <div class="adds-stu">
        <form action="add_do.php" method="post">
            <div>
                <p>s_days:</p>
                <input type="text" name="s_days" id="">
            </div>
            <div>
                <p>s_time:</p>
                <input type="text" name="s_time" id="">
            </div>
            <div>
                <p>course_id:</p>
                <input type="text" name="course_id" id="">
            </div>
            <div>
                <p>advisor_id:</p>
                <input type="text" name="advisor_id" id="">
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