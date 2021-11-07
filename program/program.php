<?php
include '../mysql.php';
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
        <title>Program Information</title>
        
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
    
    <body id="programInfoPage">
        
    <!-- Navbar -->
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#AdvisorPage"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Student</a></li>
                        <li><a href="../advisor/advisor.php">Advisor</a></li>
                        <li><a href="../faculty/faculty.php">Faculty</a></li>
                        <li><a href="../course/course.php">Course</a></li>
                        <li><a href="../session/session.php">Session</a></li>
                        <li><a href="../prereq/prereqs.php">Prerequisites</a></li>
                        <li><a href="../program/program.php">Program</a></li>
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
                    <a href="add.php">Add Program Information</a><br>
                    <?php echo mysqli_num_rows($result); ?> program(s) exist.
                </div>
            </div>

            <div class="col justify-content-center">
                <table class="table">
                    <th>ID</th>
                    <th>Type</th>
                    <th>Program Name</th>
                    <th>Options</th>
                    
                    <?php
                    if (mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                            ?>
                            <tr>
                                <td><?php echo  $row['program_id'];  ?></td>
                                <td><?php echo  $row['type'];  ?></td>
                                <td><?php echo  $row['program_name'];  ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo  $row['program_id'];  ?>">Update</a> | 
                                    <a href="javascript:del_sure(<?php echo  $row['program_id'];  ?>)">Delete</a> | 
                                    <a href="detail.php?id=<?php echo  $row['program_id'];  ?>">Details</a>
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
                
                <script>
                    function del_sure(id){
                        if (confirm("Confirm to delete") ==true)
                        {
                            window.location.href="delete.php?id="+id;
                        }
                        else
                        {
                            return ;
                        }
                    }
                </script>
            </div>
        </div>
        
    </body>
</html>