<?php
include '../mysql.php';
if(isset($_GET['id']))
{
$id = $_GET['id'];
$sql = "select * from course where course_id=$id";
$result = mysqli_query($conn,$sql);
$sql = "select * from session where course_id=$id";
$result2 = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Course Information</title>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <link rel="stylesheet" href="../RegistrationStyle.css" > 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
            
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    
    <body id="updateCoursePage">
        
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
                    <h2 class="head">Update Course Infromation</h2>
                </div>
            </div>
            <div class="row">
                <div class="col justify-content-center">
                    <form class="form-horizontal"  action="edit_do.php" method="post">
                        <?php
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="courseName">Name:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="name" id="" value="<?php echo  $row['course_name'];  ?>">
                                        <input class="form-control" type="hidden" name="id" id="" value="<?php echo  $row['course_id'];  ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="credit">Credits:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="credit" id="" value="<?php echo  $row['credit'];  ?>">
                                    </div>  
                                </div>
<!--                                <div class="form-group col-md-6">-->
<!--                                    <label class="control-label col-md-4" for="Quota">Quota:</label>-->
<!--                                    <div class="col-md-8">-->
<!--                                        <input class="form-control" type="text" name="quota" id="" value="--><?php //echo  $row['quota'];  ?><!--">-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="Semester">Semester:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="semester" id="" value="<?php echo  $row['semester'];  ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="Year">Year:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="year" id="" value="<?php echo  $row['year'];  ?>">
                                    </div>
                                </div>
<!--                                <div class="form-group col-md-6">-->
<!--                                    <label class="control-label col-md-4" for="enrollment">Open For Enrollment:</label>-->
<!--                                    <div class="col-md-8">-->
<!--                                        <input class="form-control" type="text" name="opne_for_enrollment" id="" value="--><?php //echo  $row['opne_for_enrollment'];  ?><!--">-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="Department">Department ID:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="department_id" id="" value="<?php echo  $row['department_id'];  ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="Prereq">Prereq ID:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="prereq_id" id="" value="<?php echo  $row['prereq_id'];  ?>">
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
                    <table style="margin-top:60px" align="center" width="60%" border="" cellspacing="0" cellpadding="0">
                        <tr><th>id</th><th>s_days</th><th>s_time</th><th>course_id</th><th>advisor_id</th><th>location</th>
<!--                            <th>Options</th>-->
                        </tr>
                        <?php
                        if(mysqli_num_rows($result2) > 0){
                            while ($row = mysqli_fetch_assoc($result2)) {
                                ?>
                                <tr style='background-color:aqua'>
                                    <td align="center"><?php echo  $row['session_id'];  ?></td>
                                    <td align="center"><?php echo  $row['s_days'];  ?></td>
                                    <td align="center"><?php echo  $row['s_time'];  ?></td>
                                    <td align="center"><?php echo  $row['course_id'];  ?></td>
                                    <td align="center"><?php echo  $row['advisor_id'];  ?></td>
                                    <td align="center"><?php echo  $row['location'];  ?></td>
<!--                                    <td align="center">-->
<!--                                        <a href="edit.php?id=--><?php //echo  $row['session_id'];  ?><!--" style="color:forestgreen">Update</a> | <a href="javascript:del_sure(--><?php //echo  $row['session_id'];  ?><!--)" style="color:crimson">Delete</a>|<a href="detail.php?id=--><?php //echo  $row['session_id'];  ?><!--" style="color:forestgreen">detail</a>-->
<!--                                    </td>-->
                                </tr>
                                <?php
                            }
                        }else{
                            echo 'No data';
                        }
                        ?>
                    </table>
                    <form action="add_session_do.php" method="post">
                     add session
                    <div>
                        <p>s_days:</p>
                        <input type="text" name="s_days" id="">
                    </div>
                    <div>
                        <p>s_time:</p>
                        <input type="text" name="s_time" id="">
                    </div>
                    <div hidden>
                        <p>course_id:</p>
                        <input type="text" name="course_id" value="<?php echo  $id;  ?>" id="">
                    </div>
                    <div>
                        <p>quota:</p>
                        <input type="text" name="quota" id="">
                    </div>
                    <div>
                        <p>advisor_id:</p>
                        <input type="text" name="advisor_id" id="">
                    </div>
                    <div>
                        <p>location:</p>
                        <input type="text" name="location" id="">
                    </div>
                    <div style="text-align: center">
                        <button >Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>