<?php
include 'mysql.php';

$sql = "select * from course";
$result = mysqli_query($conn,$sql);
$courses =  [];
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] =$row;
}
$year_sql = "select * from course";
$year_result = mysqli_query($conn,$year_sql);
$year = $semester = [];
while ($row = mysqli_fetch_assoc($year_result)) {
    $year[] =$row['year'];
    $semester[]=$row['semester'];
}
$year = array_unique($year);
$semester = array_unique($semester);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reports</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="../RegistrationStyle.css" > 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <script src="https://cdn.staticfile.org/jquery/3.1.1/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
        <a style="margin: 10px" href="../login.php">Log out</a>
    </head>

<body id="app4">
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

        <div class="container-fluid bg-grey text-center" >
            <div class="row">
                <div class="col">
                    <h2 class="head">Reports</h2>
                </div>
            </div>

            <form class="form-horizontal"  action="edit_student_do.php" method="post">
                <div class="form-group col-md-6">
                    <label class="control-label col-md-4" for="courseName">Course:</label>
                    <div class="col-md-8">
                        <select class="form-control" name="course"  id="courseid">
                            <?php
                            foreach ($courses as $item){
                                ?>
                                <option value ="<?php echo  $item['course_id'];  ?>"  ><?php echo  $item['course_name'];  ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label col-md-4" for="GPA">GPA:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="gpa1" id="gpa1" onfocus="this.value=''" value="(From 1)">
                        <input class="form-control" type="text" name="gpa2" id="gpa2" onfocus="this.value=''" value="(To 4)">
                        <span class="btn btn-default" onclick="report_by_student()">Go</span>
                    </div>
                </div>
            </form>
            <table class="table">
                <th>Student Name</th>
                <th>Program</th>
                <th>Grade</th>
                <tbody id="tbody">
                </tbody>
            </table>
        </div>

        <div class="container-fluid bg-grey text-center" >
            <div class="row">
                <div class="col">
                    <form class="form-horizontal" action="edit_student_do.php" method="post">
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4" for="studentName">Year:</label>
                            <div class="col-md-8">
                                <select class="form-control" name="year"  id="year" >
                                    <?php
                                    foreach ($year as $item){
                                        ?>
                                        <option value ="<?php echo  $item;  ?>" ><?php echo  $item;  ?></option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-md-4">Semester:</label>
                            <div class="col-md-8">

                                <select class="form-control" name="semester"  id="semester" >
                                    <?php
                                    foreach ($semester as $item){
                                        ?>
                                        <option value ="<?php echo  $item;  ?>"><?php echo  $item;  ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    <div class="form-group col-md-6">
                        <label class="control-label col-md-4"  for="enrollmentCount">Enrollment Count:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="count1"  id="count1" onfocus="this.value=''" value="(From 1)">
                            <input class="form-control" type="text" name="count2" id="count2"  onfocus="this.value=''" value="(To 100)">
                            <span class="btn btn-default" onclick="report_by_student1()">Go</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col justify-content-center">
            <table class="table">
                <tr>
                    <th>Course Name</th>
                    <th>Credit</th>
                    <th>department</th>
                    <th>Enrollment Count</th>
                </tr>
                <tbody id="tbody1">
                </tbody>
            </table>
        </div>
    </div>
</body>

<script>
    function report_by_student(){
                var $gpa1 = $("#gpa1").val(),
                    $courseid  = $("#courseid").val(),
                    $gpa2  = $("#gpa2").val()
                $.ajax({
                    type: "POST",
                    url: "edit_student_do.php",
                    data: {method:"report_by_student",gpa1:$gpa1,gpa2:$gpa2,courseid:$courseid},
                    dataType: "json",
                    success: function(data){
                        console.log(data)
                        $("#tbody").html("");
                        for (var i=0;i<data.length;i++)
                        {
                            console.log(data[i])
                           var tr = " <tr><td>"+data[i]['student_name']+"</td><td>"+data[i]['program']+"</td><td>"+data[i]['grade']+"</td></tr>"
                            $("#tbody").append(tr)
                        }

                    }
                })
            }

    function report_by_student1(){
        var $year = $("#year").val(),
            $semester  = $("#semester").val(),
            $count1  = $("#count1").val(),
            $count2  = $("#count2").val()
        $.ajax({
            type: "POST",
            url: "edit_student_do.php",
            data: {method:"report_by_student1",year:$year,semester:$semester,count1:$count1,count2:$count2},
            dataType: "json",
            success: function(data){
                console.log(data)
                $("#tbody1").html("");
                for (var i=0;i<data.length;i++)
                {
                    console.log(data[i])
                    var tr = " <tr><td>"+data[i]['course_name']+"</td><td>"+data[i]['credit']+"</td><td>"+data[i]['department_id']+"</td><td>"+data[i]['enrollment_count']+"</td></tr>"
                    $("#tbody1").append(tr)
                }

            }
        })
    }
</script>
</html>