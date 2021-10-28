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
    <title>Add Course Info</title>
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
    <h2 class="head" style="text-align:center">Add course Info</h2>
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
                <p>quota:</p>
                <input type="text" name="quota" id="">
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
                <p>opne_for_enrollment:</p>
                <input type="text" name="opne_for_enrollment" id="">
            </div>
            <div>
                <p>department_id:</p>
                <input type="text" name="department_id" id="">
            </div>
            <div>
                <p>prereq_id:</p>
                <input type="text" name="prereq_id" id="">
            </div>
            <div style="text-align: center">
                <button >Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>