<?php
include '../mysql.php';
if(isset($_GET['id']))
{
$id = $_GET['id'];
$sql = "select * from course where course_id=$id";
$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Course Info</title>
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
    <h2 class="head" style="text-align:center">Update Course Info</h2>
    <div class="adds-stu">
        <form action="edit_do.php" method="post">
            <?php
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    ?>
                    <div>
                        <p>Name:</p>
                        <input type="text" name="name" id="" value="<?php echo  $row['name'];  ?>">
                        <input type="hidden" name="id" id="" value="<?php echo  $row['course_id'];  ?>">
                    </div>
                    <div>
                        <p>credit:</p>
                        <input type="text" name="credit" id="" value="<?php echo  $row['credit'];  ?>">
                    </div>
                    <div>
                        <p>quota:</p>
                        <input type="text" name="quota" id="" value="<?php echo  $row['quota'];  ?>">
                    </div>
                    <div>
                        <p>semester:</p>
                        <input type="text" name="semester" id="" value="<?php echo  $row['semester'];  ?>">
                    </div>
                    <div>
                        <p>year:</p>
                        <input type="text" name="year" id="" value="<?php echo  $row['year'];  ?>">
                    </div>
                    <div>
                        <p>open_for_enrollment:</p>
                        <input type="text" name="opne_for_enrollment" id="" value="<?php echo  $row['opne_for_enrollment'];  ?>">
                    </div>
                    <div>
                        <p>department_id:</p>
                        <input type="text" name="department_id" id="" value="<?php echo  $row['department_id'];  ?>">
                    </div>
                    <div>
                        <p>prereq_id:</p>
                        <input type="text" name="prereq_id" id="" value="<?php echo  $row['prereq_id'];  ?>">
                    </div>
                    <div>
                        <button>Submit</button>
                    </div>
                    <?php
                }
            }else
            {
                echo 'No data';
            }
            }
            ?>
        </form>
    </div>
</div>
</body>
</html>