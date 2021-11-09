<?php
include '../mysql.php';
session_start();
$student_id = $_SESSION['student_id'];
$sql = "select student.*,program.program_name from student join program on program.program_id = student.program_id and student_id=$student_id = $student_id;
";
$result = mysqli_query($conn,$sql);
$student_info = mysqli_fetch_assoc($result);
if (empty($student_info)){
    echo ' Insertion fail!';
    header("refresh:1;url=../login.php");
    print('Loading...<br>Will redirect to login page after 1 seconds');
}
$name = $student_info['name'];

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
$sql2 = "select enrollment.* ,course.*,session .* from enrollment left join course on enrollment.course_id=course.course_id  left join session on enrollment.course_id=session.course_id  where enrollment.student_id = '$student_id' and  enrollment.course_id  in ($coursrIds) group by enrollment_id ";
$result2 = mysqli_query($conn,$sql2);
$sql_GPA = "select sum( grade * credit)/sum(credit) as gpa from enrollment left join course on enrollment.course_id =course.course_id  where enrollment.student_id = '$student_id' and  enrollment.course_id  in ($coursrIds) group by enrollment_id ";
$resultGPA = mysqli_query($conn,$sql_GPA);
$resultGPA = mysqli_fetch_assoc($resultGPA);
if ($resultGPA){
    $resultGPA = $resultGPA['gpa'];
}
$gpa = bcdiv($resultGPA ?? 0,1,2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Homepage</title>
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
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
</head>
<body>
<div class="adds-stu-wrap" style="display: block">
    <h2 class="head" style="text-align:center"> Student Profile</h2>
    <div class="adds-stu">
        <form action="edit_do.php" method="post">
                    <div>
                        <p>Name:</p>
                        <input type="text" name="name" id="" value="<?php echo  $student_info['name'];  ?>">
                        <input type="hidden" name="id" id="" value="<?php echo  $student_info['student_id'];  ?>">
                        <input type="hidden" name="method" id="" value="edit_student_do">
                    </div>
                    <div>
                        <p>Tel:</p>
                        <input type="text" name="tel" id="" value="<?php echo  $student_info['tel'];  ?>">
                    </div>
                    <div>
                        <p>Email:</p>
                        <input type="text" name="email" id="" value="<?php echo  $student_info['email'];  ?>">
                    </div>

                    <div>
                        <p> Password:</p>
                        <input type="text" name="password" id="" value="<?php echo  $student_info['password'];  ?>">
                    </div>
                    <div>
                        <p>address:</p>
                        <input type="text" name="address" id="" value="<?php echo  $student_info['address'];  ?>">
                    </div>
                    <div>
                        <p>program:</p>
                        <input type="text" name="program" id="" disabled value="<?php echo  $student_info['program_name'];  ?>">
                    </div>
                    <div>
                        <p>Date of Birth:</p>
                        <input type="text" name="dob" id="" value="<?php echo  $student_info['dob'];  ?>">
                    </div>
                    <div>
                        <button>update</button>
                    </div>
        </form>
    </div>
</div>


<div style="margin-top: 500px;text-align: center">

    <h2 class="head" style="text-align:center">Enrollment Info</h2>

    <a href="add_enrollment.php?id=<?php echo  $student_info['student_id'];  ?>" style="padding:3px;font-size:16px;background-color:greenyellow">Add New Course</a>
</div>
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
<table style="margin-top:100px" align="center"  width="60%" border="" cellspacing="0" cellpadding="0">
    <tr><th>course</th><th>credit</th><th>grade</th><th>year</th><th>semester</th><th>session</th>
        <?php
        if($year_get == '2021' && $semester_get == 'Fall'){
            ?>
            <th>options</th>
            <?php
        }else{
            ?>
            <th>date_enrolled</th><th>date_dropped</th>
            <?php
        }
        ?>
    </tr>
    <?php
    if ($result2){
        if(mysqli_num_rows($result2) > 0){
            while ($row = mysqli_fetch_assoc($result2)) {
                ?>
                <tr style='background-color:aqua'>
                    <td align="center"><?php echo  $row['course_name'];  ?></td>
                    <td align="center"><?php echo  $row['credit'];  ?></td>
                    <td align="center"><?php echo  $row['grade'];  ?></td>
                    <td align="center"><?php echo  $row['year'];  ?></td>
                    <td align="center"><?php echo  $row['semester'];  ?></td>
                    <td align="center"><?php echo  $row['session_name'];  ?></td>

                    <?php
                    if($year_get == '2021' && $semester_get == 'Fall'){
                    ?>
                    <td align="center" >
                       <a href="#" onclick="delete_enrollment(<?php echo  $row['enrollment_id'];  ?>)" > delete</a>
                    </td>
                        <?php
                    }else{
                        ?>
                        <td align="center"><?php echo  $row['date_enrolled'];  ?></td>
                        <td align="center"><?php echo  $row['date_dropped'];  ?></td>
                        <?php
                    }
                            ?>
                </tr>
                <?php
            }
        }}
    ?>
</table>
<div style="text-align: center">
    <?php
    if($year_get != '2021' || $semester_get != 'Fall'){
    ?>
    Team GPA:<?php echo  $gpa;  ?>
    <?php
    }
    ?>
</div>

</body>

<script>
    function search(){
        var $year = $("#year").val(),
            $semester  = $("#semester").val();
        location.href = 'index_student.php?year='+$year+'&semester='+$semester+'&id='+<?php echo  $student_id;  ?>
    }



    function delete_enrollment(enrollment_id){
            $.ajax({
                type: "POST",
                url: "edit_student_do.php",
                data: {method:"delete_enrollment",enrollment_id:enrollment_id},
                dataType: "json",
                success: function(data){
                    var $year = $("#year").val(),
                        $semester  = $("#semester").val();
                    location.href = 'index_student.php?year='+$year+'&semester='+$semester+'&id='+<?php echo  $student_id;  ?>
                }
            });
    }
</script>
</html>