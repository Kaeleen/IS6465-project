<?php
include '../mysql.php';
session_start();
$student_id = $_SESSION['student_id'];
$sql = "select student.*,program.program_name from student join program on program.program_id = student.program_id and student_id=$student_id = $student_id;
";
$result = mysqli_query($conn,$sql);
$student_info = mysqli_fetch_assoc($result);
$name = $student_info['name'];

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update student info</title>
    <style>
        .adds-stu-wrap{
            width: 700px;
            height: auto;
            margin: 0 auto;
            margin-top: 100px;

        }
        .adds-stu{
            float: left;
            width: 100%;
            height: auto;
            background-color: #eee;
            padding: 15px 10px;
        }
        .adds-stu div{
            float: left;
            width: 100%;
            margin-bottom: 20px;
        }
        .adds-stu div>p{
            float: left;
            width: 100px;
            margin: 0 10px 0 0;
            text-align: right;

        }
        .adds-stu div>input{
            float: left;
            width: 260px;
        }
    </style>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
</head>
<body>
<div class="adds-stu-wrap" style="display: block">
    <h2 class="head" style="text-align:center"> Student Profile</h2>
    <div class="adds-stu">
        <form action="edit_do.php" method="post">
                    <div>
                        <p>Name:</p>
                        <input type="text" name="name" disabled id="" value="<?php echo  $student_info['name'];  ?>">
                        <input type="hidden" name="id" id="" value="<?php echo  $student_info['student_id'];  ?>">
                        <input type="hidden" name="method" id="" value="edit_student_do">
                    </div>
                    <div>
                        <p>Tel:</p>
                        <input type="text" name="tel" id=""  disabled value="<?php echo  $student_info['tel'];  ?>">
                    </div>
                    <div>
                        <p>Address:</p>
                        <input type="text" name="address" id="" disabled value="<?php echo  $student_info['address'];  ?>">
                    </div>
                     <div>
                        <p>Email:</p>
                        <input type="text" name="email" id="" disabled value="<?php echo  $student_info['email'];  ?>">
                    </div>
                    <div>
                        <p>program:</p>
                        <input type="text" name="program" id="" disabled value="<?php echo  $student_info['program_name'];  ?>">
                    </div>
                    <div>
                        <p>Date of Birth:</p>
                        <input type="text" name="dob" id=""  disabled value="<?php echo  $student_info['dob'];  ?>">
                    </div>
                    <div>
                    </div>
        </form>
    </div>
</div>

<!--add begin-->
<div class="adds-stu-wrap" style="display: block">
    <h2 class="head" style="text-align:center">Add Course </h2>
    <div class="adds-stu">
        <form action="edit_do.php" method="post">
            <div style="text-align: center;margin-top: 80px">
                <p>Year:</p>
                <input type="text" name="year" id="year" disabled value="2021">

            </div>
            <div style="text-align: center;margin-top: 80px">
                <p>Semester:</p>
                <input type="text" name="semester" id="semester" disabled value="Fall">

            </div>
            <div style="text-align: center;margin-top: 80px">
                course:
                <select name="course" id="course" onchange="get_session()">

                </select>
                session:
                <select name="session" id="session">

                </select>
            </div>
            <div>
                <input type="hidden" name="student" id="" value="<?php echo  $student_info['student_id'];  ?>">
                <input type="hidden" name="method" id="" value="add_enrollment">
            </div>
            <div>
                <button>add course</button>
            </div>
        </form>
    </div>
</div>
<!--add end-->


</body>

<script>
    function get_course(){
        var $year = $("#year").val(),
            $semester  = $("#semester").val();
        $.ajax({
            type: "POST",
            url: "edit_do.php",
            data: {method:"get_course",year:$year,semester:$semester},
            dataType: "json",
            success: function(data){
            console.log(data)
                
                var pIndex = -1;
                var course = document.getElementById("course");
                document.getElementById("course").innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    var op = new Option(data[i]['course_anme'],data[i]['course_id']);
                    course.options.add(op);
                }
                get_session()
            }
        });
    }
    get_course()

    function get_session(){
        var courseid = $("#course").val();
            $.ajax({
            type: "POST",
            url: "edit_do.php",
            data: {method:"get_session",courseid:courseid},
            dataType: "json",
            success: function(data){
                console.log(data)
                var pIndex = -1;
                var session = document.getElementById("session");
                document.getElementById("session").innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    var op = new Option(data[i]['session_name'],data[i]['session_id']);
                    session.options.add(op);
                }
            }
        });
    }

</script>
</html>