<?php
include '../mysql.php';
session_start();
$name = $_SESSION['user'];
$advisor_id = $_SESSION['advisor_id'];

$sql = "select student.*,program.program_name from student join program on program.program_id = student.program_id";
$result = mysqli_query($conn,$sql);

if(isset($_SESSION['user'])){
}else{
    header('Refresh:0.0001;url=../login.php');
    echo "<script> alert('illegal access!')</script>";
    exit();
}
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Advisor Homepage</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../RegistrationStyle.css" > 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <h3>logged user:<?php echo $_SESSION['user']?></h3>
        <a style="margin: 10px" href="../login.php">log out</a>

    </head>

    <body id="OptionsPage">
        
    <!-- Navbar -->
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#OptionsPage"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index_advisor.php">Student</a></li>
                        <li><a href="course/course.php">Course</a></li>
                        <li><a href="report.php">Reports</a></li>
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
                <div class="col">
                    <?php echo mysqli_num_rows($result); ?> student(s) exist.
                </div>
            </div>
                
            <div class="col justify-content-center">
                <table class="table">
                    <th style="text-align:center">ID</th>
                    <th style="text-align:center">Name</th>
                    <th style="text-align:center">Program</th>
                    <th style="text-align:center">Options</th>

                    <?php
                    if (mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                    ?>
                            <tr>
                                <td><?php echo  $row['student_id'];  ?></td>
                                <td><?php echo  $row['name'];  ?></td>
                                <td><?php echo  $row['program_name'];  ?></td>
                                <td> 
                                    <a href="edit_student.php?year=2021&semester=Fall&id=<?php echo  $row['student_id'];  ?>">Detail</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        echo 'No data';
                    }
                    ?>
                </table>
            </div>
        </div>
        
    </body>
</html>