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
        <title>Add Program Information</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../RegistrationStyle.css" > 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <a style="margin: 10px" href="../login.php">log out</a>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">


    </head>
    
    <body id="addPrgromInfoPage">
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
                    <h2 class="head">Add Program Information</h2>
                </div>
            </div>
        
            <form class="form-horizontal" action="add_do.php" method="post">
                <div class="form-group col-md-6">
                    <label class="control-label col-md-4" for="programType">Type:</label>
                     <div class="col-md-8">
                        <input class="form-control" type="text" name="type" id="">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label col-md-4" for="programName">Name:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="name" id="">
                    </div>
                </div>
                <div style="text-align: center">
                    <button class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </body>
</html>