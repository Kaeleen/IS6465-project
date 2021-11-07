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
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

    </head>
    
    <body id="AddStudentPage">
        
    <!-- Navbar -->
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#myPage"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Student</a></li>
                        <li><a href="advisor/advisor.php">Advisor</a></li>
                        <li><a href="faculty/faculty.php">Faculty</a></li>
                        <li><a href="course/course.php">Course</a></li>
                        <li><a href="session/session.php">Session</a></li>
                        <li><a href="prereq/prereqs.php">Prerequisites</a></li>
                        <li><a href="program/program.php">Program</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
    <!-- Header -->
        <div class="jumbotron text-center">
            <h1>INTI College</h1>
        </div>
    
    <!-- Table -->
        <div class="container-fluid bg-grey text-center" >
            <div class="row">
                
                <div class="col-md-4">
                    <form action="add_student_do.php" method="post">
                        Name:<br>
                        <input type="text" name="name"><br>
                        Password:<br>
                        <input type="text" name="password"><br>
                        <br>
                        <p>Program: </p>
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
                        <br>
                        Email: <input type="text" name="email"><br>
                        <br>
                        Address: <input type="text" name="address"><br>
                        
                        <br>
                        Tel.: <input type="text" name="tel" id="">
                        <input type='submit' value='Add Student'>
                    </form>
                </div>
                
<!-- can't submit multiple forms with single button in HTML

                <div class="col-md-4">
                    <form action="add_student_do.php" method="post">
                        <p>Program: </p>
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
                        <br>
                        <br>
                        <label for="major">Major:</label>
                        <select name="major" id="major">
                          <option value="option1">option1</option>
                          <option value="option2">option2</option>
                          <option value="option3">option3</option>
                          <option value="option4">option4</option>
                        </select>
                        <br>
                    </form>
                </div>
                
                <div class="col-md-4">
                    <form action="add_student_do.php" method="post">
                        Email: <input type="text" name="email"><br>
                        
                        <br>
                        Tel.: <input type="text" name="tel" id="">
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form>
                        <input type='submit' value='Add Student'>
                    </form>
-->
                </div>
            </div>
<!--        </div>-->
        
    </body>
</html>