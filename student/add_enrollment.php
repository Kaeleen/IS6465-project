<?php
include '../mysql.php';
session_start();
$student_id = $_SESSION['student_id'];
$sql = "select student.*,program.program_name from student join program on program.program_id = student.program_id and student_id=$student_id";
$result = mysqli_query($conn,$sql);
$student_info = mysqli_fetch_assoc($result);
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

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Enrollment</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../RegistrationStyle.css" > 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
        <a style="margin: 10px" href="../login.php">Log out</a>
        
    </head>
    <body id="AddEnrollmentPage">
        
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
                            <input class="form-control" type="text" name="name" id="" disabled value="<?php echo  $student_info['name'];  ?>">
                            <input type="hidden" name="id" id="" value="<?php echo  $student_info['student_id'];  ?>">
                            <input type="hidden" name="method" id="" value="edit_student_do">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4" for="studentName">Telephone:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="tel" id="" disabled value="<?php echo  $student_info['tel'];  ?>">
                        </div>   
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4" for="studentName">Email:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="email" id="" disabled value="<?php echo  $student_info['email'];  ?>">
                        </div>    
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4" for="studentName">Password:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="password" id="" disabled value="<?php echo  $student_info['password'];  ?>">
                        </div>   
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4" for="studentName">Address:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="address" id="" disabled value="<?php echo  $student_info['address'];  ?>">
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
                            <input class="form-control" type="text" name="dob" id="" disabled value="<?php echo  $student_info['dob'];  ?>">
                        </div> 
                    </div>
                </form>
            </div>
        </div>

     <!--add begin-->
            <div class="container-fluid bg-grey text-center" >
                <div class="row">
                    <div class="col">
                        <h2 class="head">Add Course </h2>
                    </div>
                </div>


                <form class="form-horizontal" action="edit_do.php" method="post">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="year">Year:</label>
                            <div class="col-md-8">
                                <input class="form-control"  type="text" name="year" id="year" disabled value="2021">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="semester">Semester:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="semester" id="semester" disabled value="Fall">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="course">Course:</label>
                            <div class="col-md-8">
                                <select class="form-control"  name="course" id="course" onchange="get_session()"></select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="session">Session:</label>
                            <div class="col-md-8">
                                <select class="form-control"  name="session" id="session"></select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="student" id="" value="<?php echo  $student_info['student_id'];  ?>">
                        <input type="hidden" name="method" id="" value="add_enrollment">
                    </div>
                    <div>
                        <button class="btn btn-default">Add Course</button>
                    </div>
                    
                </form>
            </div>
        
    <!--add end-->
        </div>
    </body>

<script>
    function get_course(){
        var $year = $("#year").val(),
            $semester  = $("#semester").val();
        $.ajax({
            type: "POST",
            url: "edit_do.php",
            data: {method:"get_course",year:$year,semester:$semester},
            dataType: "json",
            success: function(data){
            console.log(data)
                
                var pIndex = -1;
                var course = document.getElementById("course");
                document.getElementById("course").innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    var op = new Option(data[i]['course_anme'],data[i]['course_id']);
                    course.options.add(op);
                }
                get_session()
            }
        });
    }
    get_course()

    function get_session(){
        var courseid = $("#course").val();
            $.ajax({
            type: "POST",
            url: "edit_do.php",
            data: {method:"get_session",courseid:courseid},
            dataType: "json",
            success: function(data){
                console.log(data)
                var pIndex = -1;
                var session = document.getElementById("session");
                document.getElementById("session").innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    var op = new Option(data[i]['session_name'],data[i]['session_id']);
                    session.options.add(op);
                }
            }
        });
    }

</script>
</html>