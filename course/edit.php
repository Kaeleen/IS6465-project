<?php
include '../mysql.php';
if(isset($_GET['id']))
{
$id = $_GET['id'];
$sql = "select * from course where course_id=$id";
$result = mysqli_query($conn,$sql);
$sql = "select session.*,course.*,advisor.name as advisor from session  left join course on course.course_id=session.course_id  left join advisor on advisor.advisor_id=session .advisor_id  where session.course_id=$id";
$result2 = mysqli_query($conn,$sql);
$sql1 = "select * from prereq";
$prereq_result = mysqli_query($conn,$sql1);

$sql2 = "select * from faculty";
$faculty_result = mysqli_query($conn,$sql2);

$sql3 = "select * from advisor";
$advisor_result = mysqli_query($conn,$sql3);

$sql4 = "select * from department";
$department_result = mysqli_query($conn,$sql4);
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
            <a style="margin: 10px" href="../login.php">log out</a>
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
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="Department">Department:</label>
                                <select name="department_id">
                                    <?php
                                    if(mysqli_num_rows($department_result) > 0){
                                        while ($row1 = mysqli_fetch_assoc($department_result)) {
                                            ?>
                                            <option value ="<?php echo  $row1['department_id'];  ?>" <?php if ($row['department_id'] == $row1['department_id']){ ?>selected="" <?php } ?>><?php echo  $row1['department_name'];  ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="Prereq">Prereq:</label>
                                    <?php
                                    if(mysqli_num_rows($prereq_result) > 0){
                                        $all_prereq_id = explode(',',$row['prereq_id']);
                                        while ($row1 = mysqli_fetch_assoc($prereq_result)) {
                                            ?>
                                            <label><input type="checkbox" name="prereq_id[]" value="<?php echo  $row1['prereq_id'];  ?>"  <?php if (in_array($row1['prereq_id'],$all_prereq_id)){ ?>checked="checked" <?php } ?>  /><?php echo  $row1['prereq_name'];  ?></label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div>
                                    <button class="btn btn-default">Update</button>
                                </div>
                                <?php
                            }
                        }
                        }
                        ?>
                    </form>
                </div>
            </div>


            <div class="col justify-content-center">
                <table class="table">
                    <tr>
                        <th>id</th>
                        <th>Session Days</th>
                        <th>Session Time</th>
                        <th>Session limit</th>
                        <th>Advisor</th>
                        <th>Location</th>
                         <th>Options</th>
                    </tr>
                    <?php
                    if(mysqli_num_rows($result2) > 0){
                        while ($row = mysqli_fetch_assoc($result2)) {
                            ?>
                            <tr>
                                <td align="center"><?php echo  $row['session_id'];  ?></td>
                                <td align="center"><?php echo  $row['s_days'];  ?></td>
                                <td align="center"><?php echo  $row['s_time'];  ?></td>
                                <td align="center"><?php echo  $row['quota'];  ?></td>
                                <td align="center"><?php echo  $row['advisor'];  ?></td>
                                <td align="center"><?php echo  $row['location'];  ?></td>
                                    <td align="center">
                                        <a href="edit_session.php?id=<?php echo  $row['session_id'];  ?>" style="color:forestgreen">Update</a> | <a href="javascript:del_sure(<?php echo  $row['session_id'];  ?>)" style="color:crimson">Delete</a>
                                    </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>

             <div class="container-fluid bg-grey text-center" >
                <div class="row">
                    <div class="col">
                        <h3 class="head">Add Session Information</h3>
                    </div>
                </div>


                <form class="form-horizontal" action="add_session_do.php" method="post">
                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4" for="sessionDays">Session Days:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="s_days" id="">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4" for="sessionTime">Session Time:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="s_time" id="">
                        </div>
                    </div>

                    <div class="form-group col-md-6" hidden>
                        <label class="control-label col-md-4" for="courseID">Course Name:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="course_id" value="<?php echo  $id;  ?>" id="">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4" for="quota">Student Limit:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="quota" id="">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4" for="advisorID">Advisor:</label>
                        <div class="col-md-8">
                            <select name="advisor_id">
                                <?php
                                if(mysqli_num_rows($advisor_result) > 0){
                                    while ($row1 = mysqli_fetch_assoc($advisor_result)) {
                                        ?>
                                        <option value ="<?php echo  $row1['advisor_id'];  ?>"><?php echo  $row1['name'];  ?></option>
                                        <?php
                                    }
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

                    <div style="text-align: center">
                        <button class="btn btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script>
        function del_sure(id){
            if(confirm("Confirm to delete") ==true){
                window.location.href="delete_session.php?id="+id+"&couser_id="+<?php echo  $id;  ?>;
            }else{
                return ;
            }
        }
    </script>
</html>