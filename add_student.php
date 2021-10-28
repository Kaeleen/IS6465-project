<?php
include 'mysql.php';
$sql = "select * from program";
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
    <title>Add Student Info</title>
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
    <h2 class="head" style="text-align:center">Add Student Info</h2>
    <div class="adds-stu">
        <form action="add_student_do.php" method="post">
            <div>
                <p>Name:</p>
                <input type="text" name="name" id="">
            </div>
            <div>
                <p>Program:</p>

                <select name="program">
                    <?php
                    if(mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value ="<?php echo  $row['program_name'];  ?>"><?php echo  $row['program_name'];  ?></option>
                            <?php
                        }
                    }else{
                        echo 'No data';
                    }
                    ?>
                </select>
            </div>
            <div>
                <p>Tel.:</p>
                <input type="text" name="tel" id="">
            </div>
            <div style="text-align: center">
                <button >Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>