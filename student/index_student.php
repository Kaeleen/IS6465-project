<?php
//include 'mysql.php';
include '../mysql.php';
session_start();
$student_id = $_SESSION['student_id'];
$sql = "select student.*,program.program_name from student join program on program.program_id = student.program_id and student_id=$student_id;
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
        <title>Student Homepage</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="RegistrationStyle.css" > 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
        <a style="margin: 10px" href="../login.php">Go Back</a>
    </head>
    
    <body id="StudentHomePage">
        
    <!-- Header -->
        <div class="jumbotron text-center">
            <h1>INTI College</h1>
        </div>
             
        <div class="container-fluid bg-grey text-center" >
            <div class="row">
                <div class="col">
                    <h2 class="head">Student Profile</h2>
                </div>
            </div>
        <div class="row">
            <div class="col justify-content-center">
                <form class="form-horizontal"  action="edit_do.php" method="post">
                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4" for="studentName">Name:</label>
                                <div class="col-md-8">
                                <input class="form-control" type="text" name="name" id="" value="<?php echo  $student_info['name'];  ?>">
                                <input type="hidden" name="id" id="" value="<?php echo  $student_info['student_id'];  ?>">
                                <input type="hidden" name="method" id="" value="edit_student_do">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Telephone:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="tel" id="" value="<?php echo  $student_info['tel'];  ?>">
                            </div>   
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Email:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="email" id="" value="<?php echo  $student_info['email'];  ?>">
                            </div>    
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Password:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="password" id="" value="<?php echo  $student_info['password'];  ?>">
                            </div>   
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Address:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="address" id="" value="<?php echo  $student_info['address'];  ?>">
                            </div>    
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Program:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="program" id="" disabled value="<?php echo  $student_info['program_name'];  ?>">
                            </div>   
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Date of Birth:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="dob" id="" value="<?php echo  $student_info['dob'];  ?>">
                            </div> 
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <button class="btn btn-default">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
 

        <div class="container-fluid bg-grey text-center" >
            <div class="row">
                <div class="col">
                    <h2 class="head">Enrollment Infomation</h2>
                </div>
            </div>
            
            <a href="add_enrollment.php?id=<?php echo  $student_info['student_id'];  ?>">Add New Course</a>
        
            <div>
                <label for="studentName">Year:</label>
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
                <button class="btn btn-default" onclick="search()">Go</button>
            </div>
            
            <div class="col justify-content-center">
                <table class="table">
                    <th style="text-align:center">Course</th>
                    <th style="text-align:center">Credit</th>
                    <th style="text-align:center">Grade</th>
                    <th style="text-align:center">Year</th>
                    <th style="text-align:center">Semester</th>
                    <th style="text-align:center">Session</th>
                    <th style="text-align:center">Date_enrolled</th>
                    <th style="text-align:center">Date_dropped</th>
                    <?php
                    if($year_get == '2021' && $semester_get == 'Fall'){
                        ?>
                        <th style="text-align:center">options</th>
                        <?php
                    }
                    ?>

                    <?php
                    if ($result2){
                        if(mysqli_num_rows($result2) > 0){
                            while ($row = mysqli_fetch_assoc($result2)) {
                                ?>
                                <tr>
                                    <td><?php echo  $row['course_name'];  ?></td>
                                    <td><?php echo  $row['credit'];  ?></td>
                                    <td><?php echo  $row['grade'];  ?></td>
                                    <td><?php echo  $row['year'];  ?></td>
                                    <td><?php echo  $row['semester'];  ?></td>
                                    <td><?php echo  $row['session_name'];  ?></td>
                                    <td><?php echo  $row['date_enrolled'];  ?></td>
                                    <td><?php echo  $row['date_dropped'];  ?></td>
                                    <?php
                                    if($year_get == '2021' && $semester_get == 'Fall'){
                                    ?>
                                    <td >
                                       <a href="#" onclick="delete_enrollment(<?php echo  $row['enrollment_id'];  ?>)" > delete</a>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                        }}
                    ?>
                </table>
        
            <div>
                <?php
                if($year_get != '2021' || $semester_get != 'Fall'){
                ?>
                Term GPA:<?php echo  $gpa;  ?>
                <?php
                }
                ?>
            </div>
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
                url: "edit_do.php",
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