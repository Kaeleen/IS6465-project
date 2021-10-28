<?php
include '../mysql.php';
if(isset($_GET['id']))
{
$id = $_GET['id'];
$sql = "select * from session where session_id=$id";
$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update session info</title>
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
    <h2 class="head" style="text-align:center">Update session info</h2>
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
                        <input type="text" name="s_days" id="" value="<?php echo  $row['s_days'];  ?>">
                        <input type="hidden" name="id" id="" value="<?php echo  $row['session_id'];  ?>">
                    </div>
                    <div>
                        <p>s_time:</p>
                        <input type="text" name="s_time" id="" value="<?php echo  $row['s_time'];  ?>">
                    </div>
                    <div>
                        <p>course_id:</p>
                        <input type="text" name="course_id" id="" value="<?php echo  $row['course_id'];  ?>">
                    </div>
                    <div>
                        <p>advisor_id:</p>
                        <input type="text" name="advisor_id" id="" value="<?php echo  $row['advisor_id'];  ?>">
                    </div>
                    <div>
                        <p>location:</p>
                        <input type="text" name="location" id="" value="<?php echo  $row['location'];  ?>">
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