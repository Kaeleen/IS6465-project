<?php
include '../mysql.php';
if(isset($_GET['id']))
{
$id = $_GET['id'];
$sql = "select * from session left join course on course.course_id=session.course_id where session_id=$id";
$result = mysqli_query($conn,$sql);

$sql3 = "select * from advisor";
$advisor_result = mysqli_query($conn,$sql3);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Session Information</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../RegistrationStyle.css" > 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <a style="margin: 10px" href="../login.php">log out</a>

    </head>
    
    <body id="updateSessInfoPage">
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
                    <h2 class="head">Update Session Information</h2>
                </div>
            </div>

            <div class="row">
                <div class="col justify-content-center">
                    <form class="form-horizontal" action="edit_session_do.php" method="post">
                    <?php
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            ?>
                            <div class="form-group col-md-6">
                                <label class="control-label col-md-4">Name:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="s_days" id="" value="<?php echo  $row['s_days'];  ?>">
                                    <input class="form-control" type="hidden" name="id" id="" value="<?php echo  $row['session_id'];  ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label col-md-4" for="sessionTime">Session Time:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="s_time" id="" value="<?php echo  $row['s_time'];  ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label col-md-4" for="sessionCourse">Course:</label>
                                <div class="col-md-8">
                                    <span><?php echo  $row['course_name'];  ?></span>
                                    <input type="text" name="course_id" id="" hidden value="<?php echo  $row['course_id'];  ?>">
                                            </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label col-md-4" for="sessionAdvisor">Advisor ID:</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="advisor_id">
                                        <?php
                                        if(mysqli_num_rows($advisor_result) > 0){
                                            while ($row1 = mysqli_fetch_assoc($advisor_result)) {
                                                ?>
                                                <option value ="<?php echo  $row1['advisor_id'];  ?>" <?php if ($row['advisor_id'] == $row1['advisor_id']){ ?>selected="" <?php } ?>><?php echo  $row1['name'];  ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label col-md-4" for="sessionLocation">Location:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="location" id="" value="<?php echo  $row['location'];  ?>">
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-default">Submit</button>
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
        </div>
    </body>
</html>