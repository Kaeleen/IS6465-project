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
        <title>Add New Course</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../RegistrationStyle.css" > 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <a style="margin: 10px" href="../login.php">log out</a>
    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

    </head>
    
    <body id="addNewCourseAdminPage">
                
    <!-- Navbar -->
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#OptionsPage"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../index_admin.php">Student</a></li>
                        <li><a href="../advisor/advisor.php">Advisor</a></li>
                        <li><a href="../faculty/faculty.php">Faculty</a></li>
                        <li><a href="../course/course.php">Course</a></li>
                        <li><a href="../program/program.php">Program</a></li>
                        <li><a href="../report.php">Reports</a></li>
                        <li><a href="../prereq/prereqs.php">Prerequisites</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
    <!-- Header -->
        <div class="jumbotron text-center">
            <h1>INTI College</h1>
        </div>
        
        <div class="container-fluid bg-grey text-center" >
            <div class="row">
                <div class="col">
                    <h2 class="head">Add New Course</h2>
                </div>
            </div>
            
            <div class="row">
                <div class="col justify-content-center">
                    <form class="form-horizontal" action="add_do.php" method="post">
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="courseName">Name:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="name" id="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="credit">Credit:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="credit" id="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="semester">Semester:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="semester" id="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="year">Year:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="year" id="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="department">Department:</label>
                            <div class="col-md-8">
                                <select class="form-control" name="department">
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
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="prereq">Prerequisite:</label>
                            <div class="col-md-8">
                                <select class="form-control" name="prereq">
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
                        </div>
                        <div class="row">
                            <div class="col">
                                <h3 class="head">Session</h3>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="sessDays">Session Days:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="s_days" id="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="sessTime">Session Time:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="s_time" id="">
                            </div>
                        </div>
                         <!--    <div>
                                <p>course_id:</p>
                                <input type="text" name="course_id" id="">
                            </div> -->
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentLimit">Student Limit:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="quota" id="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="advisor">Advisor:</label>
                            <div class="col-md-8">
                                <select class="form-control" name="advisor">
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
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="location">Location:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="location" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <button class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>