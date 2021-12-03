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
<html>
    <head>
        <title>Add Student Information</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="RegistrationStyle.css" > 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
    </head>
    
    <body id="AddStudentInfoPage">
        
    <!-- Navbar -->
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#OptionsPage"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index_admin.php">Student</a></li>
                        <li><a href="advisor/advisor.php">Advisor</a></li>
                        <li><a href="faculty/faculty.php">Faculty</a></li>
                        <li><a href="course/course.php">Course</a></li>
                        <li><a href="program/program.php">Program</a></li>
                        <li><a href="report.php">Reports</a></li>
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
                    <h2 class="head">Add Student Information</h2>
                </div>
            </div>
            <div class="row">
                <div class="col justify-content-center">
                    <form class="form-horizontal"  action="add_student_do.php" method="post">
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Name:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="name" id="" >
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Telephone:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="tel" id="">
                            </div>   
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Email:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="email" id="">
                            </div>    
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Password:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="password" id="">
                            </div>   
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Address:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="address" id="">
                            </div>    
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Program:</label>
                            <div class="col-md-8">
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
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Date of Birth:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="dob" id="">
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