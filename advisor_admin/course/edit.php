<?php
include '../../mysql.php';
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
            <a style="margin: 10px" href="../../login.php">log out</a>
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
                        <li><a href="../index_advisor.php">Student</a></li>
                        <li><a href="../course/course.php">Course</a></li>
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
                                        <input class="form-control" type="text" disabled name="name" id="" value="<?php echo  $row['course_name'];  ?>">
                                        <input class="form-control" type="hidden" name="id" id="" value="<?php echo  $row['course_id'];  ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="credit">Credits:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" disabled type="text" name="credit" id="" value="<?php echo  $row['credit'];  ?>">
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
                                        <input class="form-control" disabled type="text" name="semester" id="" value="<?php echo  $row['semester'];  ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="Year">Year:</label>
                                    <div class="col-md-8">
                                        <input class="form-control"  disabled type="text" name="year" id="" value="<?php echo  $row['year'];  ?>">
                                    </div>
                                </div>
<!--                                <div class="form-group col-md-6">-->
<!--                                    <label class="control-label col-md-4" for="enrollment">Open For Enrollment:</label>-->
<!--                                    <div class="col-md-8">-->
<!--                                        <input class="form-control" type="text" name="opne_for_enrollment" id="" value="--><?php //echo  $row['opne_for_enrollment'];  ?><!--">-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="form-group col-md-6">
                                    <label class="control-label col-md-4" for="Department">Department:</label>
<!--                                    <div class="col-md-8">-->
<!--                                        <input class="form-control" type="text" name="department_id" id="" value="--><?php //echo  $row['department_id'];  ?><!--">-->
<!--                                    </div>-->
                                <select name="department_id" disabled>
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
                        <th align="center">id</th>
                        <th align="center">Session Days</th>
                        <th align="center">Session Time</th>
                        <th align="center">Session limit</th>
                        <th align="center">Advisor</th>
                        <th align="center">Location</th>
<!--                         <th>Options</th>-->
                    </tr>
                    <?php
                    if(mysqli_num_rows($result2) > 0){
                        while ($row = mysqli_fetch_assoc($result2)) {
                            ?>
                            <tr>
                                <td><?php echo  $row['session_id'];  ?></td>
                                <td><?php echo  $row['s_days'];  ?></td>
                                <td><?php echo  $row['s_time'];  ?></td>
                                <td><?php echo  $row['quota'];  ?></td>
                                <td><?php echo  $row['advisor'];  ?></td>
                                <td><?php echo  $row['location'];  ?></td>
<!--                                    <td align="center">-->
<!--                                        <a href="edit.php?id=--><?php //echo  $row['session_id'];  ?><!--" style="color:forestgreen">Update</a> | <a href="javascript:del_sure(--><?php //echo  $row['session_id'];  ?><!--)" style="color:crimson">Delete</a>|<a href="detail.php?id=--><?php //echo  $row['session_id'];  ?><!--" style="color:forestgreen">detail</a>-->
<!--                                    </td>-->
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>

        </div>
    </body>
</html>